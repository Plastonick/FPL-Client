<?php

use Plastonick\FPLClient\Transport\Client;

require_once 'vendor/autoload.php';

// initiate the client
$client = Client::create();

// get a player by ID
$player = $client->getPlayerById(1);

// get the player's team
$team = $player->getTeam();

// get upcoming fixtures for a player
$fixtures = $player->getFixtures();

// get performances by player
$performances = $player->getPerformances();

// get various stats for a performance
$points = $performances[0]?->getTotalPoints();

// get the fixture for a performance
$fixture = $performances[0]?->getFixture();
