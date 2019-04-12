<?php

namespace FPL\Entity;

use DateTime;
use Exception;

class Fixture implements Game
{
    private $id;
    private $kickoffTime;
    private $eventName;
    private $isHome;
    private $difficulty;
    private $code;
    private $homeTeamScore;
    private $awayTeamScore;
    private $finished;
    private $minutes;
    private $provisionalStartTime;
    private $finishedProvisional;
    private $eventId;
    private $awayTeamId;
    private $homeTeamId;

    /**
     * @param array $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->eventName = $data['event_name'];
        $this->isHome = $data['is_home'];
        $this->difficulty = $data['difficulty'];
        $this->code = $data['code'];
        $this->kickoffTime = new DateTime($data['kickoff_time']);
        $this->homeTeamScore = $data['team_h_score'];
        $this->awayTeamScore = $data['team_a_score'];
        $this->finished = $data['finished'];
        $this->minutes = $data['minutes'];
        $this->provisionalStartTime = $data['provisional_start_time'];
        $this->finishedProvisional = $data['finished_provisional'];
        $this->eventId = $data['event'];
        $this->awayTeamId = $data['team_a'];
        $this->homeTeamId = $data['team_h'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getKickoffTime(): DateTime
    {
        return $this->kickoffTime;
    }

    public function getHomeTeamId(): int
    {
        return $this->homeTeamId;
    }

    public function getAwayTeamId(): int
    {
        return $this->awayTeamId;
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }

    public function getEventName(): string
    {
        return $this->eventName;
    }

    public function isHome(): bool
    {
        return $this->isHome;
    }

    public function getDifficulty(): int
    {
        return $this->difficulty;
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

    public function getOpponentTeamId(): int
    {
        if ($this->isHome()) {
            return $this->awayTeamId;
        }

        return $this->homeTeamId;
    }

    public function getSelfTeamId(): int
    {
        if ($this->isHome()) {
            return $this->homeTeamId;
        }

        return $this->awayTeamId;
    }
}
