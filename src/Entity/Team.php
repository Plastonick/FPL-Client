<?php

namespace Plastonick\FPLClient\Entity;

class Team
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getId(): int
    {
        return (int) $this->data['id'];
    }

    public function getStrength(): Strength
    {
        return new Strength($this->data);
    }

    public function getCurrentFixture(): ?int
    {
        return $this->data['current_fixture'] ?? null;
    }

    public function getNextFixture(): ?int
    {
        return $this->data['next_fixture'] ?? null;
    }

    public function getName(): string
    {
        return $this->data['name'];
    }

    public function getCode(): string
    {
        return $this->data['code'];
    }

    public function getShortName(): string
    {
        return $this->data['short_name'];
    }

    public function getUnavailable(): bool
    {
        return (bool) ($this->data['unavailable'] ?? false);
    }

    public function isPlayed(): bool
    {
        return (bool) ($this->data['played'] ?? false);
    }

    public function getTeamDivision(): ?int
    {
        return $this->data['team_division'] ?? null;
    }
}
