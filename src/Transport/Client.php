<?php

namespace FPL\Transport;

use FPL\Entity\Player;
use FPL\Entity\Team;

class Client
{
    const BASE_URL = 'https://fantasy.premierleague.com/drf/';

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
        $bootstrapCacheFile = '/tmp/fpl-api/bootstrapcache';

        if (!file_exists($bootstrapCacheFile)) {
            $this->cacheStatic($bootstrapCacheFile);
        }

        $static = json_decode(file_get_contents($bootstrapCacheFile), true);

        return $static;
    }

    private function cacheStatic(string $bootstrapCacheFile): void
    {
        $curl = new Curl(self::BASE_URL . 'bootstrap-static');

        mkdir('/tmp/fpl-api');
        file_put_contents($bootstrapCacheFile, $curl->getResponse());
    }
}
