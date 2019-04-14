<?php

namespace Plastonick\FPLClient\Entity;

class Performance
{
    private $wasHome;
    private $totalPoints;
    private $value;
    private $transfersBalance;
    private $selected;
    private $transfersIn;
    private $transfersOut;
    private $loanedIn;
    private $loanedOut;
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
    private $openPlayCrosses;
    private $bigChancesCreated;
    private $clearancesBlocksInterceptions;
    private $recoveries;
    private $keyPasses;
    private $tackles;
    private $winningGoals;
    private $attemptedPasses;
    private $completedPasses;
    private $penaltiesConceded;
    private $bigChancesMissed;
    private $errorsLeadingToGoal;
    private $errorsLeadingToGoalAttempt;
    private $tackled;
    private $offside;
    private $targetMissed;
    private $fouls;
    private $dribbles;
    private $element;
    private $fixture;

    public function __construct(array $data)
    {
        $this->wasHome = (bool) $data['was_home'];
        $this->totalPoints = (int) $data['total_points'];
        $this->value = (int) $data['value'];
        $this->transfersBalance = (int) $data['transfers_balance'];
        $this->selected = (int) $data['selected'];
        $this->transfersIn = (int) $data['transfers_in'];
        $this->transfersOut = (int) $data['transfers_out'];
        $this->loanedIn = (int) $data['loaned_in'];
        $this->loanedOut = (int) $data['loaned_out'];
        $this->minutes = (int) $data['minutes'];
        $this->goalsScored = (int) $data['goals_scored'];
        $this->assists = (int) $data['assists'];
        $this->cleanSheets = (int) $data['clean_sheets'];
        $this->goalsConceded = (int) $data['goals_conceded'];
        $this->ownGoals = (int) $data['own_goals'];
        $this->penaltiesSaved = (int) $data['penalties_saved'];
        $this->penaltiesMissed = (int) $data['penalties_missed'];
        $this->yellowCards = (int) $data['yellow_cards'];
        $this->redCards = (int) $data['red_cards'];
        $this->saves = (int) $data['saves'];
        $this->bonus = (int) $data['bonus'];
        $this->bps = (int) $data['bps'];
        $this->influence = (float) $data['influence'];
        $this->creativity = (float) $data['creativity'];
        $this->threat = (float) $data['threat'];
        $this->ictIndex = (float) $data['ict_index'];
        $this->eaIndex = (int) $data['ea_index'];
        $this->openPlayCrosses = (int) $data['open_play_crosses'];
        $this->bigChancesCreated = (int) $data['big_chances_created'];
        $this->clearancesBlocksInterceptions = (int) $data['clearances_blocks_interceptions'];
        $this->recoveries = (int) $data['recoveries'];
        $this->keyPasses = (int) $data['key_passes'];
        $this->tackles = (int) $data['tackles'];
        $this->winningGoals = (int) $data['winning_goals'];
        $this->attemptedPasses = (int) $data['attempted_passes'];
        $this->completedPasses = (int) $data['completed_passes'];
        $this->penaltiesConceded = (int) $data['penalties_conceded'];
        $this->bigChancesMissed = (int) $data['big_chances_missed'];
        $this->errorsLeadingToGoal = (int) $data['errors_leading_to_goal'];
        $this->errorsLeadingToGoalAttempt = (int) $data['errors_leading_to_goal_attempt'];
        $this->tackled = (int) $data['tackled'];
        $this->offside = (int) $data['offside'];
        $this->targetMissed = (int) $data['target_missed'];
        $this->fouls = (int) $data['fouls'];
        $this->dribbles = (int) $data['dribbles'];
        $this->element = (int) $data['element'];
    }

    public function wasHome(): bool
    {
        return $this->wasHome;
    }

    public function getTotalPoints(): int
    {
        return $this->totalPoints;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getTransfersBalance(): int
    {
        return $this->transfersBalance;
    }

    public function getSelected(): int
    {
        return $this->selected;
    }

    public function getTransfersIn(): int
    {
        return $this->transfersIn;
    }

    public function getTransfersOut(): int
    {
        return $this->transfersOut;
    }

    public function getLoanedIn(): int
    {
        return $this->loanedIn;
    }

    public function getLoanedOut(): int
    {
        return $this->loanedOut;
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

    public function getOpenPlayCrosses(): int
    {
        return $this->openPlayCrosses;
    }

    public function getBigChancesCreated(): int
    {
        return $this->bigChancesCreated;
    }

    public function getClearancesBlocksInterceptions(): int
    {
        return $this->clearancesBlocksInterceptions;
    }

    public function getRecoveries(): int
    {
        return $this->recoveries;
    }

    public function getKeyPasses(): int
    {
        return $this->keyPasses;
    }

    public function getTackles(): int
    {
        return $this->tackles;
    }

    public function getWinningGoals(): int
    {
        return $this->winningGoals;
    }

    public function getAttemptedPasses(): int
    {
        return $this->attemptedPasses;
    }

    public function getCompletedPasses(): int
    {
        return $this->completedPasses;
    }

    public function getPenaltiesConceded(): int
    {
        return $this->penaltiesConceded;
    }

    public function getBigChancesMissed(): int
    {
        return $this->bigChancesMissed;
    }

    public function getErrorsLeadingToGoal(): int
    {
        return $this->errorsLeadingToGoal;
    }

    public function getErrorsLeadingToGoalAttempt(): int
    {
        return $this->errorsLeadingToGoalAttempt;
    }

    public function getTackled(): int
    {
        return $this->tackled;
    }

    public function getOffside(): int
    {
        return $this->offside;
    }

    public function getTargetMissed(): int
    {
        return $this->targetMissed;
    }

    public function getFouls(): int
    {
        return $this->fouls;
    }

    public function getDribbles(): int
    {
        return $this->dribbles;
    }

    public function getElement(): int
    {
        return $this->element;
    }

    public function getFixture(): Fixture
    {
        return $this->fixture;
    }

    public function setFixture(Fixture $fixture): void
    {
        $this->fixture = $fixture;
    }
}
