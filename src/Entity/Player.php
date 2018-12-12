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
        $this->setId($bootstrap['id'])
            ->setFirstName($bootstrap['first_name'])
            ->setSecondName($bootstrap['second_name'])
            ->setPositionId($bootstrap['element_type'])
            ->setTeamId($bootstrap['team']);
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
        $this->fixtures = $this->buildFixtures($data['fixtures']);
        $this->history = $this->buildFixtures($data['history']);
    }

    public function setId(int $id): Player
    {
        $this->id = $id;

        return $this;
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setSecondName(string $secondName): Player
    {
        $this->secondName = $secondName;

        return $this;
    }

    public function setPositionId(int $positionId): Player
    {
        $this->positionId = $positionId;

        return $this;
    }

    public function setTeamId(int $teamId): Player
    {
        $this->teamId = $teamId;

        return $this;
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
