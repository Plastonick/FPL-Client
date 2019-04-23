<?php

namespace Plastonick\FPLClient\Transport;

use Exception;
use Phpfastcache\Exceptions\PhpfastcacheDriverCheckException;
use Phpfastcache\Exceptions\PhpfastcacheLogicException;
use Phpfastcache\Exceptions\PhpfastcacheSimpleCacheException;
use Phpfastcache\Helper\Psr16Adapter;
use Plastonick\FPLClient\Entity\Fixture;
use Plastonick\FPLClient\Entity\Player;
use Plastonick\FPLClient\Entity\Team;
use Plastonick\FPLClient\Exception\AuthenticationException;
use Plastonick\FPLClient\Exception\TransportException;
use Plastonick\FPLClient\Hydration\PlayerHydrator;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Cookie\CookieJar;
use Psr\Http\Message\ResponseInterface;

class Client
{
    const BASE_URI = 'https://fantasy.premierleague.com/drf/';

    const BOOTSTRAP_TTL = 3600;

    private $client;

    private $cache;

    private $isAuthenticated = false;

    /**
     * @throws PhpfastcacheDriverCheckException
     * @throws PhpfastcacheLogicException
     * @throws PhpfastcacheSimpleCacheException
     */
    public function __construct()
    {
        $this->client = new GuzzleClient([
            'headers' => ['User-Agent' => 'plastonick-fpl-client'],
            'base_uri' => self::BASE_URI,
        ]);

        $this->cache = new Psr16Adapter('Files');
    }

    /**
     * @throws PhpfastcacheSimpleCacheException
     */
    public function clearCache()
    {
        $this->cache->clear();
    }

    /**
     * @return array
     * @throws PhpfastcacheDriverCheckException
     * @throws PhpfastcacheLogicException
     * @throws PhpfastcacheSimpleCacheException
     * @throws TransportException
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
     * @throws PhpfastcacheDriverCheckException
     * @throws PhpfastcacheLogicException
     * @throws PhpfastcacheSimpleCacheException
     * @throws TransportException
     */
    public function getAllTeams(): array
    {
        return $this->getBootstrap()->getTeams();
    }

    /**
     * @return Fixture[]
     * @throws PhpfastcacheDriverCheckException
     * @throws PhpfastcacheLogicException
     * @throws PhpfastcacheSimpleCacheException
     * @throws TransportException
     */
    public function getAllFixtures(): array
    {
        return $this->getBootstrap()->getFixtures();
    }

    /**
     * @param int $id
     *
     * @return Player|null
     * @throws PhpfastcacheDriverCheckException
     * @throws PhpfastcacheLogicException
     * @throws PhpfastcacheSimpleCacheException
     * @throws TransportException
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
     * @throws PhpfastcacheDriverCheckException
     * @throws PhpfastcacheLogicException
     * @throws PhpfastcacheSimpleCacheException
     * @throws TransportException
     */
    public function getTeamById(int $id): ?Team
    {
        return $this->getBootstrap()->getTeamById($id);
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
        $this->isAuthenticated = true;
    }

    /**
     * @return Bootstrap
     * @throws PhpfastcacheSimpleCacheException
     * @throws TransportException
     * @throws PhpfastcacheDriverCheckException
     * @throws PhpfastcacheLogicException
     */
    private function getBootstrap()
    {
        $key = 'bootstrap';

        if ($this->cache->get($key) === null) {
            $bootstrap = new Bootstrap(
                $this->getStatic(),
                $this->fetchFixtures()
            );

            $this->cache->set($key, $bootstrap, 3600);
        }

        return $this->cache->get($key);
    }

    /**
     * @param Player $player
     *
     * @throws TransportException
     * @throws Exception
     */
    private function hydratePlayer(Player $player): void
    {
        $response = $this->client->get("element-summary/{$player->getId()}");
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
        $response = $this->client->get('bootstrap-static');
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
}
