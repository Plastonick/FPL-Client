<?php

namespace FPL\Entity;

use DateTime;
use Exception;

class Match implements Game
{
    private $id;
    private $kickoffTime;
    private $homeTeamScore;
    private $awayTeamScore;
    private $isHome;
    private $selfTeamId;
    private $opponentTeamId;
    private $performance;

    /**
     * @param array $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->kickoffTime = new DateTime($data['kickoff_time']);
        $this->homeTeamScore = $data['team_h_score'];
        $this->awayTeamScore = $data['team_a_score'];
        $this->isHome = $data['was_home'];
        $this->selfTeamId = $data['self_team_id'];
        $this->opponentTeamId = $data['opponent_team'];
        $this->performance = new Performance($data);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getKickoffTime(): DateTime
    {
        return $this->kickoffTime;
    }

    public function getHomeTeamScore(): int
    {
        return $this->homeTeamScore;
    }

    public function getAwayTeamScore(): int
    {
        return $this->awayTeamScore;
    }

    public function isHome(): bool
    {
        return $this->isHome;
    }

    public function getOpponentTeamId(): int
    {
        return $this->opponentTeamId;
    }

    public function getPerformance(): Performance
    {
        return $this->performance;
    }

    public function getSelfTeamId(): int
    {
        return $this->selfTeamId;
    }
}
