<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Services\Subdomain;

use Illuminate\Redis\Connections\Connection;
use Omadonex\ToolsW2p\Interfaces\Subdomain\ISubdomainStorageBase;

class SubdomainStorageRedis implements ISubdomainStorageBase
{
    public $redisConnection;

    public function __construct(Connection $redisConnection)
    {
        $this->redisConnection = $redisConnection;
    }

    public function get($recordType, $key)
    {
        return json_decode($this->redisConnection->get("{$recordType}_$key"), true);
    }

    public function set($recordType, $key, $valueArr)
    {
        $this->redisConnection->set("{$recordType}_$key", json_encode($valueArr));
    }

    public function remove($recordType, $key)
    {
        $this->redisConnection->del(["{$recordType}_$key"]);
    }

    public function clear($recordType = null)
    {
        $pattern = (!$recordType) ? '*' : "{$recordType}_*";
        $keys = $this->redisConnection->keys($pattern);
        if (count($keys)) {
            $this->redisConnection->del($keys);
        }
    }
}