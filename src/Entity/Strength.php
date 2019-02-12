<?php

namespace FPL\Entity;

class Strength
{
    private $short;

    private $overallHome;

    private $overallAway;

    private $attackHome;

    private $attackAway;

    private $defenceHome;

    private $defenceAway;

    public function __construct(array $data)
    {
        $this->short = (int) $data['strength'];
        $this->overallHome = (int) $data['strength_overall_home'];
        $this->overallAway = (int) $data['strength_overall_away'];
        $this->attackHome = (int) $data['strength_attack_home'];
        $this->attackAway = (int) $data['strength_attack_away'];
        $this->defenceHome = (int) $data['strength_defence_home'];
        $this->defenceAway = (int) $data['strength_defence_away'];
    }

    public function getShort(): int
    {
        return $this->short;
    }

    public function getOverallHome(): int
    {
        return $this->overallHome;
    }

    public function getOverallAway(): int
    {
        return $this->overallAway;
    }

    public function getAttackHome(): int
    {
        return $this->attackHome;
    }

    public function getAttackAway(): int
    {
        return $this->attackAway;
    }

    public function getDefenceHome(): int
    {
        return $this->defenceHome;
    }

    public function getDefenceAway(): int
    {
        return $this->defenceAway;
    }
}
