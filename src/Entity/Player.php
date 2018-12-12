<?php

namespace FPL\Entity;

class Player
{
    private $id;

    private $firstName;

    private $secondName;

    private $positionId;

    private $teamId;

    public function __construct(array $data)
    {
        $this->setId($data['id'])
            ->setFirstName($data['first_name'])
            ->setSecondName($data['second_name'])
            ->setPositionId($data['element_type'])
            ->setTeamId($data['team']);
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
}
