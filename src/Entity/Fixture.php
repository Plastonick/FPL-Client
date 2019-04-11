<?php

namespace FPL\Entity;

use DateTime;
use Exception;

class Fixture
{
    private $id;

    private $kickoff;

    private $gameWeekId;

    private $homeTeamId;

    private $awayTeamId;

    private $finished;

    /**
     * @param array $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->kickoff = new DateTime($data['kickoff_time']);
        $this->gameWeekId = $data['event'] ?? null;
        $this->homeTeamId = $data['team_h'] ?? null;
        $this->awayTeamId = $data['team_a'] ?? null;
        $this->finished = $data['finished'] ?? false;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getKickoff(): DateTime
    {
        return $this->kickoff;
    }

    public function getGameWeekId(): ?int
    {
        return $this->gameWeekId;
    }

    public function getHomeTeamId(): ?int
    {
        return $this->homeTeamId;
    }

    public function getAwayTeamId(): ?int
    {
        return $this->awayTeamId;
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }
}
