<?php

namespace FPL\Entity;

use DateTime;

interface Game
{
    public function getId(): int;

    public function getKickoffTime(): DateTime;

    public function getHomeTeamScore(): ?int;

    public function getAwayTeamScore(): ?int;

    public function isHome(): bool;

    public function getSelfTeamId(): int;

    public function getOpponentTeamId(): int;
}
