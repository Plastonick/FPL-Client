<?php

namespace FPL\Entity;

use DateTime;
use Exception;

class Fixture
{
    private $id;
    private $started;
    private $deadlineTime;
    private $stats;
    private $awayTeamDifficulty;
    private $homeTeamDifficulty;
    private $code;
    private $kickoffTime;
    private $awayTeamScore;
    private $homeTeamScore;
    private $finished;
    private $minutes;
    private $provisionalStartTime;
    private $finishedProvisional;
    private $eventId;
    private $awayTeam;
    private $homeTeam;

    /**
     * @param array $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->started = $data['started'];
        $this->deadlineTime = new DateTime($data['deadline_time']);
        $this->awayTeamDifficulty = $data['team_a_difficulty'];
        $this->homeTeamDifficulty = $data['team_h_difficulty'];
        $this->code = $data['code'];
        $this->kickoffTime = new DateTime($data['kickoff_time']);
        $this->awayTeamScore = $data['team_a_score'];
        $this->homeTeamScore = $data['team_h_score'];
        $this->finished = $data['finished'];
        $this->minutes = $data['minutes'];
        $this->provisionalStartTime = $data['provisional_start_time'];
        $this->finishedProvisional = $data['finished_provisional'];
        $this->eventId = $data['event'];

        // TODO
        $this->stats = $data['stats'];
        $this->awayTeam = $data['team_a'];
        $this->homeTeam = $data['team_h'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getKickoffTime(): DateTime
    {
        return $this->kickoffTime;
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getHomeTeamScore(): ?int
    {
        return $this->homeTeamScore;
    }

    public function getAwayTeamScore(): ?int
    {
        return $this->awayTeamScore;
    }

    public function getMinutes(): int
    {
        return $this->minutes;
    }

    public function hasProvisionalStartTime(): bool
    {
        return $this->provisionalStartTime;
    }

    public function didFinishProvisional(): bool
    {
        return $this->finishedProvisional;
    }

    public function getEventId(): int
    {
        return $this->eventId;
    }

    public function hasStarted(): bool
    {
        return $this->started;
    }

    public function getDeadlineTime(): DateTime
    {
        return $this->deadlineTime;
    }

    // TODO
    /**
     * @return mixed
     */
    public function getStats()
    {
        return $this->stats;
    }

    public function getAwayTeamDifficulty(): int
    {
        return $this->awayTeamDifficulty;
    }

    public function getHomeTeamDifficulty(): int
    {
        return $this->homeTeamDifficulty;
    }

    public function hasFinished(): bool
    {
        return $this->finished;
    }

    public function getAwayTeam(): Team
    {
        return $this->awayTeam;
    }

    public function getHomeTeam(): Team
    {
        return $this->homeTeam;
    }
}
