<?php

namespace Plastonick\FPLClient\Entity;

class Stats
{
    private array $stats;

    public function __construct(array $stats)
    {
        $this->stats = $stats;
    }

    public function getStats(): array
    {
        return $this->stats;
    }
}
