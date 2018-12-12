<?php

namespace FPL\Transport;

use FPL\Entity\Player;
use FPL\Entity\Team;
use function json_decode;

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
        $curl = new Curl(self::BASE_URL . 'bootstrap-static');

        // TODO locally cache this data
        $static = json_decode($curl->getResponse(), true);

        $this->bootstrap = new Bootstrap($static);

        // instantiate players
    }

    protected function hydratePlayer(Player $player): void
    {
        $curl = new Curl(self::BASE_URL . "element-summary/{$player->getId()}");

        $player->hydrate(json_decode($curl->getResponse(), true));
    }

}
