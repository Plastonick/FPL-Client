<?php

namespace FPL\Entity;

use Exception;
use FPL\Exception\TransportException;
use FPL\Transport\Client;

class Player
{
    private $id;

    private $firstName;

    private $secondName;

    private $positionId;

    private $teamId;

    private $fixtures;

    private $history;

    public function __construct(array $bootstrap)
    {
        $this->id = $bootstrap['id'];
        $this->firstName = $bootstrap['first_name'];
        $this->secondName = $bootstrap['second_name'];
        $this->positionId = $bootstrap['element_type'];
        $this->teamId = $bootstrap['team'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Team|null
     * @throws TransportException
     */
    public function getTeam(): ?Team
    {
        return Client::get()->getTeamById($this->teamId);
    }

    public function getTeamId(): int
    {
        return $this->teamId;
    }

    /**
     * @param array $data
     *
     * @throws Exception
     */
    public function hydrate(array $data): void
    {
        $this->fixtures = $this->buildFixtures($data['fixtures'] ?? []);
        $this->history = $this->buildMatches($data['history'] ?? []);
    }

    /**
     * @param array $gameData
     *
     * @return array
     * @throws Exception
     */
    protected function buildFixtures(array $gameData): array
    {
        $fixtures = [];

        foreach ($gameData as $gameDatum) {
            $fixtures[$gameDatum['id']] = new Fixture($gameDatum);
        }

        return $fixtures;
    }

    /**
     * @param array $gameData
     *
     * @return array
     * @throws Exception
     */
    protected function buildMatches(array $gameData): array
    {
        $fixtures = [];

        foreach ($gameData as $gameDatum) {
            $gameDatum['self_team_id'] = $this->getTeamId();
            $fixtures[$gameDatum['id']] = new Match($gameDatum);
        }

        return $fixtures;
    }
}
