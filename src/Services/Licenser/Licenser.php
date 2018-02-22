<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 12.02.2018
 * Time: 15:42
 */

namespace Omadonex\ToolsW2p\Services\Licenser;

use Omadonex\ToolsW2p\Interfaces\Licenser\ILicenserChecker;
use Omadonex\ToolsW2p\Interfaces\Licenser\ILicenserFileStorage;
use Omadonex\ToolsW2p\Interfaces\Licenser\ILicenserRedisStorage;
use Omadonex\ToolsW2p\Interfaces\Licenser\ILicenserStorage;

class Licenser implements ILicenserStorage, ILicenserChecker
{
    const PERMISSION_CRM = 1;
    const PERMISSION_PRODUCTS = 2;
    const PERMISSION_EXCHANGE = 3;

    const STORAGE_TYPE_FILE = 'file';
    const STORAGE_TYPE_REDIS = 'redis';

    const RECORD_TYPE_TYPOGRAPHY = 'typography';
    const RECORD_TYPE_LICENSE = 'license';
    const RECORD_TYPE_PERMISSION = 'permission';

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
        // TODO: Implement clear() method.
    }

    public function check()
    {
        // TODO: Implement check() method.
    }
}