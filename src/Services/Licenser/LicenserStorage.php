<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 12.02.2018
 * Time: 15:42
 */

namespace Omadonex\ToolsW2p\Services\Licenser;

use Omadonex\ToolsW2p\Interfaces\Licenser\ILicenserFileStorage;
use Omadonex\ToolsW2p\Interfaces\Licenser\ILicenserRedisStorage;
use Omadonex\ToolsW2p\Interfaces\Licenser\ILicenserStorage;

class LicenserStorage implements ILicenserStorage
{
    const STORAGE_TYPE_FILE = 'file';
    const STORAGE_TYPE_REDIS = 'redis';

    protected $fileStorage;
    protected $redisStorage;
    protected $preferReadStorage;

    public function __construct(ILicenserFileStorage $fileStorage, ILicenserRedisStorage $redisStorage,
        $preferReadStorage = self::STORAGE_TYPE_REDIS)
    {
        $this->fileStorage = $fileStorage;
        $this->redisStorage = $redisStorage;
        $this->preferReadStorage = $preferReadStorage;
    }

    public function get($recordType, $key)
    {
        if ($this->preferReadStorage === self::STORAGE_TYPE_FILE) {
            return $this->fileStorage->get($recordType, $key);
        }

        return $this->redisStorage->get($recordType, $key);
    }

    public function set($recordType, $key, $valueArr)
    {
        $this->fileStorage->set($recordType, $key, $valueArr);
        $this->redisStorage->set($recordType, $key, $valueArr);
    }

    public function remove($recordType, $key)
    {
        $this->fileStorage->remove($recordType, $key);
        $this->redisStorage->remove($recordType, $key);
    }

    public function clear($recordType)
    {
        $this->fileStorage->clear($recordType);
        $this->redisStorage->clear($recordType);
    }
}