<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\Player;
use pocketmine\Server;
use VectorNetworkProject\TheMix\event\game\TheEndGameEvent;
use VectorNetworkProject\TheMix\game\corepvp\CoreManager;
use VectorNetworkProject\TheMix\game\corepvp\TeamManager;

class GameManager
{
    public static function resetGame(): void
    {
        TeamManager::resetTeam();
        CoreManager::resetHP();
        TheEndGameEvent::setFinish(false);
        foreach (Server::getInstance()->getOnlinePlayers() as $player) {
            $player->teleport(Server::getInstance()->getDefaultLevel()->getSpawnLocation());
            $player->setGamemode(Player::ADVENTURE);
            $player->setNameTag($player->getName());
            $player->setDisplayName($player->getName());
            $player->setFood(20);
            $player->setHealth(20);
            $player->setMaxHealth(20);
            $player->getInventory()->clearAll();
            $player->getArmorInventory()->clearAll();
            $player->removeAllEffects();
            $player->addEffect(new EffectInstance(Effect::getEffect(Effect::NIGHT_VISION), 99999999 * 20, 11, false));
        }
    }
}
