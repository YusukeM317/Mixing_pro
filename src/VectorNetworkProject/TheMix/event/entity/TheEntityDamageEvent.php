<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event;


use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use VectorNetworkProject\TheMix\game\corepvp\SpawnManager;

class TheEntityDamageEvent implements Listener
{
    public function event(EntityDamageEvent $event)
    {
        $entity = $event->getEntity();
        $entity->extinguish();
        if (!$entity instanceof Player) return;
        if ($event->getFinalDamage() <= $entity->getHealth()) return;
        if ($event->getCause() === EntityDamageEvent::CAUSE_FALL) {
            $event->setCancelled();
            return;
        }
        $event->setCancelled();
        SpawnManager::PlayerReSpawn($entity);
    }
}
