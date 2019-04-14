<?php

namespace FPL\Hydration;

use Exception;
use FPL\Entity\Fixture;
use FPL\Entity\Performance;
use FPL\Entity\Player;
use FPL\Exception\NonExistentRecordException;
use FPL\Transport\Bootstrap;

class PlayerHydrator
{
    private $player;

    private $bootstrap;

    public function __construct(Player $player, Bootstrap $bootstrap)
    {
        $this->player = $player;
        $this->bootstrap = $bootstrap;
    }

    /**
     * @param array $historyData
     *
     * @throws Exception
     */
    public function hydrateHistory(array $historyData): void
    {
        $performances = [];

        foreach ($historyData as $fixtureDatum) {
            $fixture = $this->bootstrap->getFixtureById($fixtureDatum['id']);

            if ($fixture === null) {
                throw new NonExistentRecordException('Failed to retrieve valid Fixture');
            }

            $performance = new Performance($fixtureDatum);
            $performance->setFixture($fixture);
        }

        $this->player->setPerformances($performances);
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
