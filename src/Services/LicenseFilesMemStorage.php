<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

use Illuminate\Redis\Connections\Connection;

class LicenseFilesMemStorage implements ILicenseFilesMemStorage
{
    protected $redisConnection;

    public function __construct(Connection $redisConnection)
    {
        $this->redisConnection = $redisConnection;
    }

    public function getPermission($permissionId)
    {
        return json_decode($this->redisConnection->get("permission_$permissionId"), true);
    }

    public function setPermission($permissionId, $arrayData)
    {
        $this->redisConnection->set("permission_$permissionId", json_encode($arrayData));
    }
}