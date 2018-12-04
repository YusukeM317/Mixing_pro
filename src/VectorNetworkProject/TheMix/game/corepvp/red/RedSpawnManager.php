<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp\red;

use pocketmine\level\Position;
use pocketmine\Server;
use VectorNetworkProject\TheMix\game\corepvp\SpawnManager;
use VectorNetworkProject\TheMix\game\DefaultConfig;

class RedSpawnManager extends SpawnManager
{
    /**
     * @return Position|null
     */
    public static function getRandomPosition(): ?Position
    {
        switch (mt_rand(1, 2)) {
            case 1:
                $spawn = RedConfig::getSpawn1();
                return new Position($spawn['x'], $spawn['y'], $spawn['z'], Server::getInstance()->getLevelByName(DefaultConfig::getStageLevelName()));
                break;
            case 2:
                $spawn = RedConfig::getSpawn2();
                return new Position($spawn['x'], $spawn['y'], $spawn['z'], Server::getInstance()->getLevelByName(DefaultConfig::getStageLevelName()));
                break;
            default:
                return null;
        }
    }
}
