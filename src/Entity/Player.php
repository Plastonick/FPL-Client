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
        $this->hydrateFixtures($data['fixtures']);
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

    /**
     * @param $fixtures
     */
    protected function hydrateFixtures($fixtures): void
    {
        foreach ($fixtures as $fixture) {
            $this->fixtures[$fixture['id']] = new Fixture($fixture);
        }
    }
}
