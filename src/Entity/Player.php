<?php

namespace Plastonick\FPLClient\Entity;

use DateTime;
use Exception;

class Player
{
    private $id;
    private $photo;
    private $webName;
    private $teamCode;
    private $status;
    private $code;
    private $firstName;
    private $secondName;
    private $squadNumber;
    private $news;
    private $nowCost;
    private $newsAdded;
    private $chanceOfPlayingThisRound;
    private $chanceOfPlayingNextRound;
    private $valueForm;
    private $valueSeason;
    private $costChangeStart;
    private $costChangeEvent;
    private $costChangeStartFall;
    private $costChangeEventFall;
    private $inDreamteam;
    private $dreamteamCount;
    private $selectedByPercent;
    private $form;
    private $transfersOut;
    private $transfersIn;
    private $transfersOutEvent;
    private $transfersInEvent;
    private $loansIn;
    private $loansOut;
    private $loanedIn;
    private $loanedOut;
    private $totalPoints;
    private $eventPoints;
    private $pointsPerGame;
    private $epThis;
    private $epNext;
    private $special;
    private $minutes;
    private $goalsScored;
    private $assists;
    private $cleanSheets;
    private $goalsConceded;
    private $ownGoals;
    private $penaltiesSaved;
    private $penaltiesMissed;
    private $yellowCards;
    private $redCards;
    private $saves;
    private $bonus;
    private $bps;
    private $influence;
    private $creativity;
    private $threat;
    private $ictIndex;
    private $eaIndex;
    private $positionId;
    private $teamId;
    private $team;
    private $fixtures;
    private $performances;

    /**
     * @param array $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->photo = $data['photo'];
        $this->webName = $data['web_name'];
        $this->teamCode = $data['team_code'];
        $this->status = $data['status'];
        $this->code = $data['code'];
        $this->firstName = $data['first_name'];
        $this->secondName = $data['second_name'];
        $this->squadNumber = $data['squad_number'];
        $this->news = $data['news'];
        $this->nowCost = $data['now_cost'];
        $this->newsAdded = new DateTime($data['news_added']);
        $this->chanceOfPlayingThisRound = $data['chance_of_playing_this_round'];
        $this->chanceOfPlayingNextRound = $data['chance_of_playing_next_round'];
        $this->valueForm = (float) $data['value_form'];
        $this->valueSeason = (float) $data['value_season'];
        $this->costChangeStart = $data['cost_change_start'];
        $this->costChangeEvent = $data['cost_change_event'];
        $this->costChangeStartFall = $data['cost_change_start_fall'];
        $this->costChangeEventFall = $data['cost_change_event_fall'];
        $this->inDreamteam = $data['in_dreamteam'];
        $this->dreamteamCount = $data['dreamteam_count'];
        $this->selectedByPercent = (float) $data['selected_by_percent'];
        $this->form = (float) $data['form'];
        $this->transfersOut = $data['transfers_out'];
        $this->transfersIn = $data['transfers_in'];
        $this->transfersOutEvent = $data['transfers_out_event'];
        $this->transfersInEvent = $data['transfers_in_event'];
        $this->loansIn = $data['loans_in'];
        $this->loansOut = $data['loans_out'];
        $this->loanedIn = $data['loaned_in'];
        $this->loanedOut = $data['loaned_out'];
        $this->totalPoints = $data['total_points'];
        $this->eventPoints = $data['event_points'];
        $this->pointsPerGame = (float) $data['points_per_game'];
        $this->epThis = (float) $data['ep_this'];
        $this->epNext = (float) $data['ep_next'];
        $this->special = $data['special'];
        $this->minutes = $data['minutes'];
        $this->goalsScored = $data['goals_scored'];
        $this->assists = $data['assists'];
        $this->cleanSheets = $data['clean_sheets'];
        $this->goalsConceded = $data['goals_conceded'];
        $this->ownGoals = $data['own_goals'];
        $this->penaltiesSaved = $data['penalties_saved'];
        $this->penaltiesMissed = $data['penalties_missed'];
        $this->yellowCards = $data['yellow_cards'];
        $this->redCards = $data['red_cards'];
        $this->saves = $data['saves'];
        $this->bonus = $data['bonus'];
        $this->bps = $data['bps'];
        $this->influence = (float) $data['influence'];
        $this->creativity = (float) $data['creativity'];
        $this->threat = (float) $data['threat'];
        $this->ictIndex = (float) $data['ict_index'];
        $this->eaIndex = $data['ea_index'];
        $this->positionId = $data['element_type'];
        $this->teamId = $data['team'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTeamId(): int
    {
        return $this->teamId;
    }

    public function getTeam(): Team
    {
        return $this->team;
    }

    public function getFullName(): string
    {
        return sprintf('%s %s', $this->getFirstName(), $this->getSecondName());
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
    }

    public function getPositionId(): int
    {
        return $this->positionId;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function getWebName(): string
    {
        return $this->webName;
    }

    public function getTeamCode(): int
    {
        return $this->teamCode;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getSquadNumber(): int
    {
        return $this->squadNumber;
    }

    public function getNews(): string
    {
        return $this->news;
    }

    public function getNowCost(): int
    {
        return $this->nowCost;
    }

    public function getNewsAdded(): DateTime
    {
        return $this->newsAdded;
    }

    public function getChanceOfPlayingThisRound(): int
    {
        return $this->chanceOfPlayingThisRound;
    }

    public function getChanceOfPlayingNextRound(): int
    {
        return $this->chanceOfPlayingNextRound;
    }

    public function getValueForm(): float
    {
        return $this->valueForm;
    }

    public function getValueSeason(): float
    {
        return $this->valueSeason;
    }

    public function getCostChangeStart(): int
    {
        return $this->costChangeStart;
    }

    public function getCostChangeEvent(): int
    {
        return $this->costChangeEvent;
    }

    public function getCostChangeStartFall(): int
    {
        return $this->costChangeStartFall;
    }

    public function getCostChangeEventFall(): int
    {
        return $this->costChangeEventFall;
    }

    public function isInDreamteam(): bool
    {
        return $this->inDreamteam;
    }

    public function getDreamteamCount(): int
    {
        return $this->dreamteamCount;
    }

    public function getSelectedByPercent(): float
    {
        return $this->selectedByPercent;
    }

    public function getForm(): float
    {
        return $this->form;
    }

    public function getTransfersOut(): int
    {
        return $this->transfersOut;
    }

    public function getTransfersIn(): int
    {
        return $this->transfersIn;
    }

    public function getTransfersOutEvent(): int
    {
        return $this->transfersOutEvent;
    }

    public function getTransfersInEvent(): int
    {
        return $this->transfersInEvent;
    }

    public function getLoansIn(): int
    {
        return $this->loansIn;
    }

    public function getLoansOut(): int
    {
        return $this->loansOut;
    }

    public function getLoanedIn(): int
    {
        return $this->loanedIn;
    }

    public function getLoanedOut(): int
    {
        return $this->loanedOut;
    }

    public function getTotalPoints(): int
    {
        return $this->totalPoints;
    }

    public function getEventPoints(): int
    {
        return $this->eventPoints;
    }

    public function getPointsPerGame(): float
    {
        return $this->pointsPerGame;
    }

    public function getEpThis(): float
    {
        return $this->epThis;
    }

    public function getEpNext(): float
    {
        return $this->epNext;
    }

    public function isSpecial(): bool
    {
        return $this->special;
    }

    public function getMinutes(): int
    {
        return $this->minutes;
    }

    public function getGoalsScored(): int
    {
        return $this->goalsScored;
    }

    public function getAssists(): int
    {
        return $this->assists;
    }

    public function getCleanSheets(): int
    {
        return $this->cleanSheets;
    }

    public function getGoalsConceded(): int
    {
        return $this->goalsConceded;
    }

    public function getOwnGoals(): int
    {
        return $this->ownGoals;
    }

    public function getPenaltiesSaved(): int
    {
        return $this->penaltiesSaved;
    }

    public function getPenaltiesMissed(): int
    {
        return $this->penaltiesMissed;
    }

    public function getYellowCards(): int
    {
        return $this->yellowCards;
    }

    public function getRedCards(): int
    {
        return $this->redCards;
    }

    public function getSaves(): int
    {
        return $this->saves;
    }

    public function getBonus(): int
    {
        return $this->bonus;
    }

    public function getBps(): int
    {
        return $this->bps;
    }

    public function getInfluence(): float
    {
        return $this->influence;
    }

    public function getCreativity(): float
    {
        return $this->creativity;
    }

    public function getThreat(): float
    {
        return $this->threat;
    }

    public function getIctIndex(): float
    {
        return $this->ictIndex;
    }

    public function getEaIndex(): int
    {
        return $this->eaIndex;
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

    public function setFixtures(array $fixtures): void
    {
        $this->fixtures = $fixtures;
    }

    public function setPerformances(array $performances): void
    {
        $this->performances = $performances;
    }

    public function setTeam(Team $team): void
    {
        $this->team = $team;
    }
}
