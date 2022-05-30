<?php

namespace Plastonick\FPLClient\Entity;

class Strength
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getStrength(): int
    {
        return $this->data['strength'];
    }

    public function getOverallHome(): int
    {
        return $this->data['strength_overall_home'];
    }

    public function getOverallAway(): int
    {
        return $this->data['strength_overall_away'];
    }

    public function getAttackHome(): int
    {
        return $this->data['strength_attack_home'];
    }

    public function getAttackAway(): int
    {
        return $this->data['strength_attack_away'];
    }

    public function getDefenceHome(): int
    {
        return $this->data['strength_defence_home'];
    }

    public function getDefenceAway(): int
    {
        return $this->data['strength_defence_away'];
    }
}
