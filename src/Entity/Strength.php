<?php

namespace FPL\Entity;

final class Strength
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
}
