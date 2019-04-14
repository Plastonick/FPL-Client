<?php

namespace Plastonick\FPLClient\Hydration;

use Exception;
use Plastonick\FPLClient\Entity\Performance;
use Plastonick\FPLClient\Entity\Player;
use Plastonick\FPLClient\Exception\NonExistentRecordException;
use Plastonick\FPLClient\Transport\Bootstrap;

class PlayerHydrator
{
    private $player;

    private $bootstrap;

    public function __construct(Player $player, Bootstrap $bootstrap)
    {
        $this->hydrateTeam($player, $bootstrap);

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

        foreach ($historyData as $performanceData) {
            $fixture = $this->bootstrap->getFixtureById($performanceData['fixture']);

            if ($fixture === null) {
                throw new NonExistentRecordException('Failed to retrieve valid Fixture');
            }

            $performance = new Performance($performanceData);
            $performance->setFixture($fixture);

            $performances[] = $performance;
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
            $fixtures[] = $this->bootstrap->getFixtureById($fixtureDatum['id']);
        }

        $this->player->setFixtures($fixtures);
    }

    private function hydrateTeam(Player $player, Bootstrap $bootstrap): void
    {
        $player->setTeam($bootstrap->getTeamById($player->getTeamId()));
    }
}
