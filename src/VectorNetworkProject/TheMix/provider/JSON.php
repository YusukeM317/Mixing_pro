<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\provider;


use pocketmine\utils\Config;
use VectorNetworkProject\TheMix\lib\database\Provider;

class JSON extends Provider
{
    /* @var string $path */
    private $path;

    /* @var string $file */
    private $file;

    /**
     * JSON constructor.
     * @param string $xuid
     * @param string $file
     */
    public function __construct(string $xuid, string $file)
    {
        $this->path = self::getPath('datas', 'json') . $xuid . '/';
        $this->file = $file . '.json';
    }

    /**
     * @param array $table
     * @return void
     */
    public function createTable(array $table = []): void
    {
        @mkdir($this->path);
        $config = new Config($this->path . $this->file, Config::JSON, $table);
        $config->save();
    }

    /**
     * @return bool
     */
    public function hasTable(): bool
    {
        return file_exists($this->path . $this->file)
            ? true
            : false;
    }

    /**
     * @return bool
     */
    public function deleteTable(): bool
    {
        return unlink($this->path . $this->file)
            ? true
            : false;
    }

    /**
     * @param string $key
     * @param bool|mixed $data
     */
    public function set(string $key, $data): void
    {
        $config = new Config($this->path . $this->file, Config::JSON);
        $config->set($key, $data);
        $config->save();
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        $config = new Config($this->path . $this->file, Config::JSON);
        return $config->get($key);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $config = new Config($this->path . $this->file, Config::JSON);
        return $config->getAll();
    }

    /**
     * @return array
     */
    public function getKeys(): array
    {
        $config = new Config($this->path . $this->file, Config::JSON);
        return $config->getAll(true);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        $config = new Config($this->path . $this->file, Config::JSON);
        return $config->exists($key)
            ? true
            : false;
    }

    /**
     * @param string $key
     * @return void
     */
    public function remove(string $key): void
    {
        $config = new Config($this->path . $this->file, Config::JSON);
        $config->remove($key);
    }
}
