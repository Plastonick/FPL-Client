<?php

namespace FPL\Transport;

use Exception;
use FPL\Entity\Player;
use FPL\Entity\Team;
use FPL\Exception\TransportException as TransportException;
use FPL\Hydration\PlayerHydrator;

class Client
{
    const BASE_URL = 'https://fantasy.premierleague.com/drf/';

    const BOOTSTRAP_TTL = 3600;

    private static $cache;

    private $bootstrap;

    /**
     * @return Client
     * @throws TransportException
     */
    public static function get()
    {
        if (!isset(self::$cache)) {
            self::$cache = new self();
        }

        return self::$cache;
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
     * @throws TransportException
     */
    private function __construct()
    {
        $static = $this->getStatic();
        $this->bootstrap = new Bootstrap($static);
    }

    /**
     * @param Player $player
     *
     * @throws TransportException
     * @throws Exception
     */
    private function hydratePlayer(Player $player): void
    {
        $curl = new Curl(self::BASE_URL . "element-summary/{$player->getId()}");
        $data = json_decode($curl->getResponse(), true);

        $hydrator = new PlayerHydrator($player);
        $hydrator->hydrateMatches($data['history']);
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
        $curl = new Curl(self::BASE_URL . 'bootstrap-static');

        $cacheDir = preg_replace('/[^\/]+$/', '', $bootstrapCachePath);
        if (!file_exists($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }

        file_put_contents($bootstrapCachePath, $curl->getResponse());
    }

    private function cacheIsValid(string $bootstrapCacheFile): bool
    {
        if (!file_exists($bootstrapCacheFile)) {
            return false;
        }

        return time() - filemtime($bootstrapCacheFile) < self::BOOTSTRAP_TTL;
    }
}
