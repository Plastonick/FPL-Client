<?php

namespace FPL\Transport;

use Exception;
use FPL\Entity\Fixture;
use FPL\Entity\Player;
use FPL\Entity\Team;
use FPL\Exception\AuthenticationException;
use FPL\Exception\TransportException;
use FPL\Hydration\PlayerHydrator;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Cookie\CookieJar;
use Psr\Http\Message\ResponseInterface;

class Client
{
    const BASE_URI = 'https://fantasy.premierleague.com/drf/';

    const BOOTSTRAP_TTL = 3600;

    private $client;

    private $bootstrap;

    private $isAuthenticated = false;

    /**
     * @throws TransportException
     */
    public function __construct()
    {
        $this->client = new GuzzleClient([
            'headers' => ['User-Agent' => 'plastonick-fpl-client'],
            'base_uri' => self::BASE_URI,
        ]);

        $this->bootstrap = new Bootstrap(
            $this->getStatic(),
            $this->fetchFixtures()
        );
    }

    /**
     * @return array
     * @throws TransportException
     */
    public function getAllPlayers(): array
    {
        $players = $this->bootstrap->getPlayers();

        foreach ($players as $player) {
            $this->hydratePlayer($player);
        }

        return $players;
    }

    public function getAllTeams(): array
    {
        return $this->bootstrap->getTeams();
    }

    /**
     * @param int $id
     *
     * @return Player|null
     * @throws TransportException
     */
    public function getPlayerById(int $id): ?Player
    {
        $player = $this->bootstrap->getPlayerById($id);

        if ($player !== null) {
            $this->hydratePlayer($player);
        }

        return $player;
    }

    public function getTeamById(int $id): ?Team
    {
        return $this->bootstrap->getTeamById($id);
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

        $hydrator = new PlayerHydrator($player, $this->bootstrap);
        $hydrator->hydrateHistory($data['history']);
        $hydrator->hydrateFixtures($data['fixtures']);
    }

    /**
     * @return array
     * @throws TransportException
     */
    private function getStatic(): array
    {
        $bootstrapCachePath = '/tmp/fpl-api/bootstrapcache';

        if (!$this->cacheIsValid($bootstrapCachePath)) {
            $this->cacheStatic($bootstrapCachePath);
        }

        $static = json_decode(file_get_contents($bootstrapCachePath), true);

        return $static;
    }

    /**
     * @param string $bootstrapCachePath
     *
     * @throws TransportException
     */
    private function cacheStatic(string $bootstrapCachePath): void
    {
        $cacheDir = preg_replace('/[^\/]+$/', '', $bootstrapCachePath);
        if (!file_exists($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }

        $response = $this->client->get('bootstrap-static');
        $this->validateResponse($response);

        file_put_contents($bootstrapCachePath, $response->getBody()->getContents());
    }

    private function cacheIsValid(string $bootstrapCacheFile): bool
    {
        if (!file_exists($bootstrapCacheFile)) {
            return false;
        }

        return time() - filemtime($bootstrapCacheFile) < self::BOOTSTRAP_TTL;
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
