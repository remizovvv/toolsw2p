<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

use Illuminate\Support\Facades\Redis;

class LicenseFilesMemStorage implements ILicenseFilesMemStorage
{
    protected $redis;

    public function __construct()
    {
        $this->redis = Redis::connection('typo');
    }

    public function getPermission($permissionId)
    {
        return $this->redis->get("permission_$permissionId");
    }

    public function setPermission($permissionId, $value)
    {
        $this->redis->set("permission_$permissionId", $value);
    }
}