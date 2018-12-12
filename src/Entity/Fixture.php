<?php

namespace FPL\Entity;

use DateTime;

class Fixture
{
    private $id;

    private $kickoff;

    private $gameWeekId;

    private $homeTeamId;

    private $awayTeamId;

    private $finished;

    public function __construct(array $data)
    {
        $this->setId($data['id'])
            ->setKickoff(new DateTime($data['kickoff_time']))
            ->setGameWeekId($data['event'])
            ->setHomeTeamId($data['team_h'])
            ->setAwayTeamId($data['team_a'])
            ->setFinished($data['finished']);
    }

    public function getId():int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getKickoff(): \DateTime
    {
        return $this->kickoff;
    }

    public function setKickoff(\DateTime $kickoff): self
    {
        $this->kickoff = $kickoff;

        return $this;
    }

    public function getGameWeekId(): int
    {
        return $this->gameWeekId;
    }

    public function setGameWeekId(int $gameWeekId): self
    {
        $this->gameWeekId = $gameWeekId;

        return $this;
    }

    public function getHomeTeamId(): int
    {
        return $this->homeTeamId;
    }

    public function setHomeTeamId(int $homeTeamId): self
    {
        $this->homeTeamId = $homeTeamId;

        return $this;
    }

    public function getAwayTeamId(): int
    {
        return $this->awayTeamId;
    }

    public function setAwayTeamId(int $awayTeamId): self
    {
        $this->awayTeamId = $awayTeamId;

        return $this;
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }

    public function setFinished(bool $finished): self
    {
        $this->finished = $finished;

        return $this;
    }
}
