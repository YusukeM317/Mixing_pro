<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\task;

use pocketmine\block\Block;
use pocketmine\scheduler\Task;

class BlockReGeneratorTask extends Task
{
    /** @var Block $block */
    private $block;

    public function __construct(Block $block)
    {
        $this->block = $block;
    }

    public function onRun(int $currentTick)
    {
        $this->getBlock()->getLevel()->setBlock($this->getBlock()->asVector3(), $this->block);
    }

    /**
     * @return Block
     */
    public function getBlock(): Block
    {
        return $this->block;
    }
}
