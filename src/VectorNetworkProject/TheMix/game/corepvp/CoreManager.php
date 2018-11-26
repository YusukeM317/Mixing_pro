<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp;


use pocketmine\block\Block;
use pocketmine\Player;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueCoreManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedCoreManager;

abstract class CoreManager
{
    public static function Break(Block $block, Player $player): void
    {
        if (RedCoreManager::isCore($block)) {
            RedCoreManager::reduceHP(1);
        } elseif (BlueCoreManager::isCore($block)) {
            BlueCoreManager::reduceHP(1);
        }
    }

    /**
     * @param int $hp
     */
    abstract public static function setHP(int $hp): void;

    /**
     * @param int $hp
     */
    abstract public static function addHP(int $hp): void;

    /**
     * @param int $hp
     */
    abstract public static function reduceHP(int $hp): void;

    /**
     * @param Block $block
     * @return bool
     */
    abstract public static function isCore(Block $block): bool;
}
