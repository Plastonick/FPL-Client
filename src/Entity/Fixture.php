<?php

namespace Plastonick\FPLClient\Entity;

use DateTime;

class Fixture
{
    private $awayTeam;
    private $homeTeam;
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getCode(): int
    {
        return $this->data['code'];
    }

    public function getEvent(): int
    {
        return $this->data['event'];
    }

    public function getFinished(): int
    {
        return $this->data['finished'];
    }

    public function getFinishedProvisional(): int
    {
        return $this->data['finished_provisional'];
    }

    public function getId(): int
    {
        return $this->data['id'];
    }

    public function getKickoffTime(): int
    {
        return DateTime::createFromFormat('Y-m-d\TH:i:se', $this->data['kickoff_time']);
    }

    public function getMinutes(): int
    {
        return $this->data['minutes'];
    }

    public function getProvisionalStartTime(): int
    {
        return $this->data['provisional_start_time'];
    }

    public function hasStarted(): bool
    {
        return $this->data['started'];
    }

    public function getAwayTeamScore(): int
    {
        return $this->data['team_a_score'];
    }

    public function getHomeTeamScore(): int
    {
        return $this->data['team_h_score'];
    }

    public function getTeamHDifficulty(): int
    {
        return $this->data['team_h_difficulty'];
    }

    public function getTeamADifficulty(): int
    {
        return $this->data['team_a_difficulty'];
    }

    public function getPulseId(): int
    {
        return $this->data['pulse_id'];
    }

    public function getAwayTeamId(): int
    {
        return $this->data['team_a'];
    }

    public function getHomeTeamId(): int
    {
        return $this->data['team_h'];
    }

    public function setAwayTeam(Team $awayTeam): void
    {
        $this->awayTeam = $awayTeam;
    }

    public function getHomeTeam(): Team
    {
        return $this->homeTeam;
    }

    public function setHomeTeam(Team $homeTeam): void
    {
        $this->homeTeam = $homeTeam;
    }

    public function getAwayTeam(): Team
    {
        return $this->awayTeam;
    }
}
