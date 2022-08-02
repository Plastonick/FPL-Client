<?php

namespace Plastonick\FPLClient\Entity;

use DateTime;
use DateTimeInterface;

class Player
{
    private array $data;
    private ?array $fixtures;
    private ?array $performances;
    private Team $team;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getChanceOfPlayingNextRound(): int
    {
        return $this->data['chance_of_playing_next_round'];
    }

    public function getChanceOfPlayingThisRound(): int
    {
        return $this->data['chance_of_playing_this_round'];
    }

    public function getCode(): int
    {
        return $this->data['code'];
    }

    public function getCostChangeEvent(): int
    {
        return $this->data['cost_change_event'];
    }

    public function getCostChangeEventFall(): int
    {
        return $this->data['cost_change_event_fall'];
    }

    public function getCostChangeStart(): int
    {
        return $this->data['cost_change_start'];
    }

    public function getCostChangeStartFall(): int
    {
        return $this->data['cost_change_start_fall'];
    }

    public function getDreamteamCount(): int
    {
        return $this->data['dreamteam_count'];
    }

    public function getElementType(): int
    {
        return $this->data['element_type'];
    }

    public function getEpNext(): float
    {
        return (float) $this->data['ep_next'];
    }

    public function getEpThis(): float
    {
        return (float) $this->data['ep_this'];
    }

    public function getEventPoints(): int
    {
        return $this->data['event_points'];
    }

    public function getFirstName(): string
    {
        return $this->data['first_name'];
    }

    public function getForm(): float
    {
        return $this->data['form'];
    }

    public function getId(): int
    {
        return $this->data['id'];
    }

    public function getInDreamteam(): bool
    {
        return $this->data['in_dreamteam'];
    }

    public function getNews(): string
    {
        return $this->data['news'];
    }

    public function getNewsAdded(): DateTimeInterface
    {
        return DateTime::createFromFormat('Y-m-d\TH:i:s.ue', $this->data['news_added']);
    }

    public function getNowCost(): int
    {
        return $this->data['now_cost'];
    }

    public function getPointsPerGame(): float
    {
        return $this->data['points_per_game'];
    }

    public function getSecondName(): string
    {
        return $this->data['second_name'];
    }

    public function getSelectedByPercent(): string
    {
        return $this->data['selected_by_percent'];
    }

    public function getSpecial(): bool
    {
        return $this->data['special'];
    }

    public function getStatus(): string
    {
        return $this->data['status'];
    }

    public function getTeamId(): int
    {
        return $this->data['team'];
    }

    public function getTeamCode(): int
    {
        return $this->data['team_code'];
    }

    public function getTotalPoints(): int
    {
        return $this->data['total_points'];
    }

    public function getTransfersIn(): int
    {
        return $this->data['transfers_in'];
    }

    public function getTransfersInEvent(): int
    {
        return $this->data['transfers_in_event'];
    }

    public function getTransfersOut(): int
    {
        return $this->data['transfers_out'];
    }

    public function getTransfersOutEvent(): int
    {
        return $this->data['transfers_out_event'];
    }

    public function getValueForm(): float
    {
        return $this->data['value_form'];
    }

    public function getValueSeason(): float
    {
        return $this->data['value_season'];
    }

    public function getWebName(): string
    {
        return $this->data['web_name'];
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

    public function getInfluenceRank(): int
    {
        return $this->data['influence_rank'];
    }

    public function getInfluenceRankType(): int
    {
        return $this->data['influence_rank_type'];
    }

    public function getCreativityRank(): int
    {
        return $this->data['creativity_rank'];
    }

    public function getCreativityRankType(): int
    {
        return $this->data['creativity_rank_type'];
    }

    public function getThreatRank(): int
    {
        return $this->data['threat_rank'];
    }

    public function getThreatRankType(): int
    {
        return $this->data['threat_rank_type'];
    }

    public function getIctIndexRank(): int
    {
        return $this->data['ict_index_rank'];
    }

    public function getIctIndexRankType(): int
    {
        return $this->data['ict_index_rank_type'];
    }

    /**
     * @return Fixture[]|null
     */
    public function getFixtures(): ?array
    {
        return $this->fixtures;
    }

    /**
     * @return Performance[]|null
     */
    public function getPerformances(): ?array
    {
        return $this->performances;
    }

    public function setFixtures(array $fixtures): self
    {
        $this->fixtures = $fixtures;

        return $this;
    }

    public function setPerformances(array $performances): self
    {
        $this->performances = $performances;

        return $this;
    }

    public function setTeam(Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getTeam(): Team
    {
        return $this->team;
    }
}
