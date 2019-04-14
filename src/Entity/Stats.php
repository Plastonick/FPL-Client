<?php

namespace FPL\Entity;

class Stats
{
    private $stats;

    public function __construct(array $stats)
    {
        $this->stats = $stats;
    }

    public function getStats(): array
    {
        return $this->stats;
    }
}
