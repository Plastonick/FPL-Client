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
        $this->players = $this->buildPlayers($static['elements']);
        $this->teams = $this->buildTeams($static['teams']);

        $this->hydrateTeams($fixtures);
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

    private function buildPlayers(array $elements): array
    {
        $players = [];

        foreach ($elements as $element) {
            $players[$element['id']] = new Player($element);
        }

        return $players;
    }

    private function buildTeams(array $teamsData): array
    {
        $teams = [];

        foreach ($teamsData as $teamData) {
            $teams[$teamData['id']] = new Team($teamData);
        }

        return $teams;
    }

    /**
     * @param array $fixtures
     */
    private function hydrateTeams(array $fixtures): void
    {
        array_walk(
            $fixtures,
            function (Fixture $fixture) {
                $awayTeam = $this->getTeamById($fixture->getAwayTeamId());
                $homeTeam = $this->getTeamById($fixture->getHomeTeamId());

                $fixture->setAwayTeam($awayTeam);
                $fixture->setHomeTeam($homeTeam);
            }
        );
    }
}
