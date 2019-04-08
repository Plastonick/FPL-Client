<?php

namespace FPL\Transport;

use FPL\Entity\Player;
use FPL\Entity\Team;

class Client
{
    const BASE_URL = 'https://fantasy.premierleague.com/drf/';

    const BOOTSTRAP_TTL = 3600;

    private static $cache;

    private $bootstrap;

    public static function get()
    {
        if (!isset(self::$cache)) {
            self::$cache = new self();
        }

        return self::$cache;
    }

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

    private function __construct()
    {
        $static = $this->getStatic();
        $this->bootstrap = new Bootstrap($static);
    }

    private function hydratePlayer(Player $player): void
    {
        $curl = new Curl(self::BASE_URL . "element-summary/{$player->getId()}");

        $player->hydrate(json_decode($curl->getResponse(), true));
    }

    private function getStatic(): array
    {
        $bootstrapCachePath = '/tmp/fpl-api/bootstrapcache';

        if (!$this->cacheIsValid($bootstrapCachePath)) {
            $this->cacheStatic($bootstrapCachePath);
        }

        $static = json_decode(file_get_contents($bootstrapCachePath), true);

        return $static;
    }

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
