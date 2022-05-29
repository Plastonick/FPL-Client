<?php

namespace Plastonick\FPLClient\Transport;

use Exception;
use Plastonick\FPLClient\RequestCache;
use Plastonick\FPLClient\Entity\Fixture;
use Plastonick\FPLClient\Entity\Player;
use Plastonick\FPLClient\Entity\Team;
use Plastonick\FPLClient\Exception\AuthenticationException;
use Plastonick\FPLClient\Exception\TransportException;
use Plastonick\FPLClient\Hydration\PlayerHydrator;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Cookie\CookieJar;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

class Client
{
    const BASE_URI = 'https://fantasy.premierleague.com/api/';

    private $client;

    /** @var CacheInterface */
    private $cache;

    public function __construct(CacheInterface $cache = null)
    {
        $this->client = new GuzzleClient([
            'headers' => ['User-Agent' => 'plastonick-fpl-client'],
            'base_uri' => self::BASE_URI,
        ]);

        $this->cache = $cache ?? $this->buildDefaultCache();
    }

    public function clearCache()
    {
        $this->cache->clear();
    }

    /**
     * @return array
     * @throws TransportException
     * @throws InvalidArgumentException
     */
    public function getAllPlayers(): array
    {
        $players = $this->getBootstrap()->getPlayers();

        foreach ($players as $player) {
            $this->hydratePlayer($player);
        }

        return $players;
    }

    /**
     * @return Team[]
     * @throws TransportException
     * @throws InvalidArgumentException
     */
    public function getAllTeams(): array
    {
        return $this->getBootstrap()->getTeams();
    }

    /**
     * @return Fixture[]
     * @throws TransportException
     * @throws InvalidArgumentException
     */
    public function getAllFixtures(): array
    {
        return $this->getBootstrap()->getFixtures();
    }

    /**
     * @param int $id
     *
     * @return Player|null
     * @throws TransportException
     * @throws InvalidArgumentException
     */
    public function getPlayerById(int $id): ?Player
    {
        $player = $this->getBootstrap()->getPlayerById($id);

        if ($player !== null) {
            $this->hydratePlayer($player);
        }

        return $player;
    }

    /**
     * @param int $id
     *
     * @return Team|null
     * @throws TransportException
     * @throws InvalidArgumentException
     */
    public function getTeamById(int $id): ?Team
    {
        return $this->getBootstrap()->getTeamById($id);
    }

    /**
     * @return Fixture[]
     * @throws TransportException
     * @throws InvalidArgumentException
     */
    public function getFixtures(): array
    {
        $key = 'fixtures';

        if (!$this->cache->has($key)) {
            $fixtures = $this->fetchFixtures();
            $this->cache->set($key, $fixtures);
        }

        return $this->cache->get($key);
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @throws TransportException
     * @throws AuthenticationException
     */
    public function authenticate(string $username, string $password)
    {
        $cookieJar = new CookieJar();
        $loginClient = new GuzzleClient([
            'headers' => ['User-Agent' => 'plastonick-fpl-client'],
            'base_uri' => 'https://users.premierleague.com/',
            'cookies' => $cookieJar,
        ]);

        $payload = [
            'password' => $password,
            'login' => $username,
            'redirect_uri' => 'https://fantasy.premierleague.com/a/login',
            'app' => 'plfpl-web',
        ];

        try {
            $loginClient->post('/accounts/login/', ['form_params' => $payload]);
        } catch (Exception $e) {
            throw new TransportException('Failed to authenticate', $e);
        }

        $message = $cookieJar->getCookieByName('messages')->getValue();
        if (strpos($message, "Successfully signed in as {$username}") === false) {
            throw new AuthenticationException('Failed to authenticate');
        }

        $this->client = new GuzzleClient([
            'headers' => ['User-Agent' => 'plastonick-fpl-client'],
            'base_uri' => self::BASE_URI,
            'cookies' => $cookieJar
        ]);
    }

    /**
     * @return Bootstrap
     * @throws TransportException
     * @throws InvalidArgumentException
     */
    private function getBootstrap()
    {
        $key = 'bootstrap';

        if (!$this->cache->has($key)) {
            $bootstrap = new Bootstrap(
                $this->getStatic(),
                $this->getFixtures()
            );

            $this->cache->set($key, $bootstrap);
        }

        return $this->cache->get($key);
    }

    /**
     * @param Player $player
     *
     * @throws TransportException
     * @throws Exception
     * @throws InvalidArgumentException
     */
    private function hydratePlayer(Player $player): void
    {
        $response = $this->client->get("element-summary/{$player->getId()}/");

        $this->validateResponse($response);

        $data = json_decode($response->getBody()->getContents(), true);

        $hydrator = new PlayerHydrator($player, $this->getBootstrap());
        $hydrator->hydrateHistory($data['history']);
        $hydrator->hydrateFixtures($data['fixtures']);
    }

    /**
     * @return array
     * @throws TransportException
     */
    private function getStatic(): array
    {
        $response = $this->client->get('bootstrap-static/');
        $this->validateResponse($response);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param ResponseInterface $response
     *
     * @throws TransportException
     */
    private function validateResponse(ResponseInterface $response): void
    {
        $stream = $response->getBody();
        if ($stream->getContents() === '') {
            throw new TransportException('Received an empty response from Fantasy API');
        }

        $stream->rewind();
    }

    /**
     * @return Fixture[]
     * @throws TransportException
     * @throws Exception
     */
    private function fetchFixtures(): array
    {
        $response = $this->client->get('fixtures');

        $this->validateResponse($response);

        $fixtureData = json_decode($response->getBody()->getContents(), true);

        $fixtures = [];
        foreach ($fixtureData as $fixtureDatum) {
            $fixtures[] = new Fixture($fixtureDatum);
        }

        return $fixtures;
    }

    /**
     * @return CacheInterface
     */
    private function buildDefaultCache(): CacheInterface
    {
        return new RequestCache();
    }
}
