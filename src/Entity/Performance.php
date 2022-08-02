<?php

namespace Plastonick\FPLClient\Entity;

use DateTime;
use DateTimeInterface;

class Performance
{
    private array $data;
    private Fixture $fixture;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getElement(): int
    {
        return $this->data['element'];
    }

    public function getOpponentTeam(): int
    {
        return $this->data['opponent_team'];
    }

    public function getTotalPoints(): int
    {
        return $this->data['total_points'];
    }

    public function getWasHome(): bool
    {
        return $this->data['was_home'];
    }

    public function getKickoffTime(): DateTimeInterface
    {
        return DateTime::createFromFormat('Y-m-d\TH:i:se', $this->data['kickoff_time']);
    }

    public function getHomeTeamScore(): int
    {
        return $this->data['team_h_score'];
    }

    public function getAwayTeamScore(): int
    {
        return $this->data['team_a_score'];
    }

    public function getRound(): int
    {
        return $this->data['round'];
    }

    public function getMinutes(): int
    {
        return $this->data['minutes'];
    }

    public function getGoalsScored(): int
    {
        return $this->data['goals_scored'];
    }

    public function getAssists(): int
    {
        return $this->data['assists'];
    }

    public function getCleanSheets(): int
    {
        return $this->data['clean_sheets'];
    }

    public function getGoalsConceded(): int
    {
        return $this->data['goals_conceded'];
    }

    public function getOwnGoals(): int
    {
        return $this->data['own_goals'];
    }

    public function getPenaltiesSaved(): int
    {
        return $this->data['penalties_saved'];
    }

    public function getPenaltiesMissed(): int
    {
        return $this->data['penalties_missed'];
    }

    public function getYellowCards(): int
    {
        return $this->data['yellow_cards'];
    }

    public function getRedCards(): int
    {
        return $this->data['red_cards'];
    }

    public function getSaves(): int
    {
        return $this->data['saves'];
    }

    public function getBonus(): int
    {
        return $this->data['bonus'];
    }

    public function getBps(): int
    {
        return $this->data['bps'];
    }

    public function getInfluence(): float
    {
        return $this->data['influence'];
    }

    public function getCreativity(): float
    {
        return $this->data['creativity'];
    }

    public function getThreat(): float
    {
        return $this->data['threat'];
    }

    public function getIctIndex(): float
    {
        return $this->data['ict_index'];
    }

    public function getValue(): int
    {
        return $this->data['value'];
    }

    public function getTransfersBalance(): int
    {
        return $this->data['transfers_balance'];
    }

    public function getSelected(): int
    {
        return $this->data['selected'];
    }

    public function getTransfersIn(): int
    {
        return $this->data['transfers_in'];
    }

    public function getTransfersOut(): int
    {
        return $this->data['transfers_out'];
    }

    public function getFixture(): Fixture
    {
        return $this->fixture;
    }

    public function setFixture(Fixture $fixture): self
    {
        $this->fixture = $fixture;

        return $this;
    }
}
