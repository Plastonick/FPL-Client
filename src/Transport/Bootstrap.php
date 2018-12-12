<?php

namespace FPL\Transport;

use FPL\Entity\Player;
use FPL\Entity\Team;

class Bootstrap
{
    private $players = [];
    private $teams = [];

    public function __construct(array $static)
    {
        $this->hydratePlayers($static['elements']);
        $this->hydrateTeams($static['teams']);
    }

    private function hydratePlayers(array $elements): void
    {
        foreach ($elements as $element) {
            $this->players[$element['id']] = new Player($element);
        }
    }

    private function hydrateTeams(array $teams): void
    {
        foreach ($teams as $team) {
            $this->teams[$team['id']] = new Team($team);
        }
    }
}
