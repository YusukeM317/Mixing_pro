<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix;


use pocketmine\plugin\PluginBase;
use VectorNetworkProject\TheMix\command\PingCommand;

class TheMix extends PluginBase
{
    /* @var TheMix $instance */
    private static $instance = null;

    public function onLoad()
    {
        self::$instance = $this;
        $this->getLogger()->notice("Loading System...");
    }

    public function onEnable()
    {
        $this->registerCommands();
        $this->getLogger()->notice("Loaded System!!");
    }

    public function onDisable()
    {
        $this->getLogger()->notice("Unload System...");
    }

    /**
     * @return TheMix
     */
    public static function getInstance(): TheMix
    {
        return self::$instance;
    }

    /**
     * @return DataBase
     */
    public static function getDataBase(): DataBase
    {
        return new DataBase();
    }

    private function registerCommands(): void
    {
        $commands = [
            new PingCommand($this)
        ];
        $this->getServer()->getCommandMap()->registerAll($this->getName(), $commands);
    }
}
