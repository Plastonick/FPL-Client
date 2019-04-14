<?php

namespace Plastonick\FPLClient\Entity;

class Team
{
    private $id;

    private $currentFixture;

    private $nextFixture;

    private $name;

    private $code;

    private $shortName;

    private $unavailable;

    private $strength;

    private $played;

    private $teamDivision;

    public function __construct(array $data)
    {
        $this->id = (int) $data['id'];
        $this->currentFixture = $data['current_fixture'] ?? null;
        $this->nextFixture = $data['next_fixture'] ?? null;
        $this->name = $data['name'];
        $this->code = $data['code'];
        $this->shortName = $data['short_name'];
        $this->unavailable = (bool) ($data['unavailable'] ?? false);
        $this->strength = new Strength($data);
        $this->played = (bool) ($data['played'] ?? false);
        $this->teamDivision = $data['team_division'] ?? null;
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
