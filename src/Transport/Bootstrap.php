<?php

namespace FPL\Transport;

use FPL\Entity\Fixture;
use FPL\Entity\Player;
use FPL\Entity\Team;

class Bootstrap
{
    private $players;
    private $teams;
    private $fixtures;

    public function __construct(array $static, array $fixtures)
    {
        $this->hydratePlayers($static['elements']);
        $this->hydrateTeams($static['teams']);
        $this->fixtures = $fixtures;
    }

    /**
     * @return Player[]
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @return Team[]
     */
    public function getTeams(): array
    {
        return $this->teams;
    }

    /**
     * @return Fixture[]
     */
    public function getFixtures(): array
    {
        return $this->fixtures;
    }

    public function getPlayerById(int $id): ?Player
    {
        return $this->players[$id];
    }

    public function getTeamById(int $id): ?Team
    {
        return $this->teams[$id];
    }

    public function getFixtureById(int $id): ?Fixture
    {
        return $this->fixtures[$id];
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
