<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\task;

use pocketmine\level\Position;
use pocketmine\Player;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;

class ReSpawnCooldownTask extends Task
{
    /** @var Player $player */
    private $player;

    /** @var Position $position */
    private $position;

    /**
     * ReSpawnCooldownTask constructor.
     *
     * @param Player   $player
     * @param Position $position
     */
    public function __construct(Player $player, Position $position)
    {
        $this->player = $player;
        $this->position = $position;
    }

    /**
     * @param int $currentTick
     */
    public function onRun(int $currentTick)
    {
        if (!$this->player->isOnline()) $this->getHandler()->cancel();
        $this->player->setGamemode(Player::SURVIVAL);
        $this->player->teleport($this->position);
        $this->player->sendMessage(TextFormat::GREEN.'行動可能になりました。');
    }
}
