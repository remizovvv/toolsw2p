<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 12.02.2018
 * Time: 15:42
 */

namespace Omadonex\ToolsW2p\Classes\Utils;

use Omadonex\ToolsW2p\Interfaces\LicenseFileStorage;
use Omadonex\ToolsW2p\Interfaces\LicenseRedisStorage;

class LicenseUtils
{
    const PERMISSION_CRM = 1;
    const PERMISSION_PRODUCTS = 2;
    const PERMISSION_EXCHANGE = 3;

    protected $fileStorage;
    protected $redisStorage;

    public function __construct(LicenseFileStorage $fileStorage, LicenseRedisStorage $redisStorage)
    {
        $this->fileStorage = $fileStorage;
        $this->redisStorage = $redisStorage;
    }

    public function addPermission($data)
    {
        $id = $data['id'];
        unset($data['id']);
        $this->fileStorage->setPermission($id, $data);
        $this->redisStorage->setPermission($id, $data);
    }

    private function get
}