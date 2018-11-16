<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\level;

use pocketmine\Player;
use pocketmine\Server;
use VectorNetworkProject\TheMix\event\game\PlayerMaxXpChangeEvent;
use VectorNetworkProject\TheMix\event\game\PlayerXpChangeEvent;
use VectorNetworkProject\TheMix\provider\JSON;

class XP
{
    /* @var string */
    public const XP = 'xp';

    /* @var string */
    public const MAX = 'max';

    /**
     * プレイヤーのXPを変更します。
     *
     * @param Player $player
     * @param int    $xp
     *
     * @return void
     */
    public static function setXP(Player $player, int $xp): void
    {
        $event = new PlayerXpChangeEvent($player, $xp);
        Server::getInstance()->getPluginManager()->callEvent($event);
        if (!$event->isCancelled()) {
            $db = new JSON($player->getXuid(), Level::FILE_NAME);
            $db->set(self::XP, $xp);
        }
    }

    /**
     * プレイヤーのXPを増やします。
     *
     * @param Player $player
     * @param int    $min
     * @param int    $max
     *
     * @return void
     */
    public static function addXP(Player $player, int $min = 10, int $max = 15): void
    {
        $xp = mt_rand($min, $max);
        $event = new PlayerXpChangeEvent($player, $xp);
        Server::getInstance()->getPluginManager()->callEvent($event);
        if (!$event->isCancelled()) {
            $db = new JSON($player->getXuid(), Level::FILE_NAME);
            $db->set(self::XP, self::getXP($player) + $xp);
        }
    }

    /**
     * プレイヤーのXPを取得します。
     *
     * @param Player $player
     *
     * @return int
     */
    public static function getXP(Player $player): int
    {
        $db = new JSON($player->getXuid(), Level::FILE_NAME);

        return $db->get(self::XP);
    }

    /**
     * プレイヤーのMaxXPを変更します。
     *
     * @param Player $player
     * @param int    $max
     *
     * @return void
     */
    public static function setMaxXP(Player $player, int $max): void
    {
        $event = new PlayerMaxXpChangeEvent($player, $max);
        Server::getInstance()->getPluginManager()->callEvent($event);
        if (!$event->isCancelled()) {
            $db = new JSON($player->getXuid(), Level::FILE_NAME);
            $db->set(self::MAX, $max);
        }
    }

    /**
     * プレイヤーのMaxXPを取得します。
     *
     * @param Player $player
     *
     * @return int
     */
    public static function getMaxXP(Player $player): int
    {
        $db = new JSON($player->getXuid(), Level::FILE_NAME);

        return $db->get(self::MAX);
    }
}
