<?php

namespace FPL\Entity;

class Team
{
    private $id;

    private $currentFixture;

    private $nextFixture;

    private $name;

    private $code;

    private $shortName;

    private $unavailable;

    // TODO
//    private $strength;

    private $played;

    private $teamDivision;

    public function __construct(array $data)
    {
        $this->id = (int) $data['id'];
        $this->currentFixture = $data['currentFixture'] ?? null;
        $this->nextFixture = $data['nextFixture'] ?? null;
        $this->name = $data['name'];
        $this->code = $data['code'];
        $this->shortName = $data['shortName'];
        $this->unavailable = (bool) ($data['unavailable'] ?? false);
        $this->played = (bool) ($data['played'] ?? false);
        $this->teamDivision = $data['teamDivision'] ?? null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCurrentFixture(): ?int
    {
        return $this->currentFixture;
    }

    public function getNextFixture(): ?int
    {
        return $this->nextFixture;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getShortName(): string
    {
        return $this->shortName;
    }

    public function getUnavailable(): bool
    {
        return $this->unavailable;
    }

    public function isPlayed(): bool
    {
        return $this->played;
    }

    public function getTeamDivision(): ?int
    {
        return $this->teamDivision;
    }
}
