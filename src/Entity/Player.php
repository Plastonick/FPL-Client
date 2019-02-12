<?php

namespace FPL\Entity;

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

    public function getTeam(): ?Team
    {
        return Client::get()->getTeamById($this->teamId);
    }

    public function hydrate(array $data)
    {
        $this->fixtures = $this->buildFixtures($data['fixtures'] ?? []);
        $this->history = $this->buildFixtures($data['history'] ?? []);
    }

    protected function buildFixtures(array $gameData): array
    {
        $fixtures = [];

        foreach ($gameData as $gameDatum) {
            $fixtures[$gameDatum['id']] = new Fixture($gameDatum);
        }

        return $fixtures;
    }
}
