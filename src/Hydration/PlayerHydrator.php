<?php

namespace FPL\Transport\Hydration;

use Exception;
use FPL\Entity\Fixture;
use FPL\Entity\Match;
use FPL\Entity\Player;

class PlayerHydrator
{
    private $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @param array $historyData
     *
     * @throws Exception
     */
    public function hydrateMatches(array $historyData): void
    {
        $history = [];

        foreach ($historyData as $matchDatum) {
            $matchDatum['self_team_id'] = $this->player->getTeamId();
            $history[$matchDatum['id']] = new Match($matchDatum);
        }

        $this->player->setHistory($history);
    }

    /**
     * @param array $fixtureData
     *
     * @throws Exception
     */
    public function hydrateFixtures(array $fixtureData): void
    {
        $fixtures = [];

        foreach ($fixtureData as $fixtureDatum) {
            $fixtures[$fixtureDatum['id']] = new Fixture($fixtureDatum);
        }

        $this->player->setFixtures($fixtures);
    }
}
