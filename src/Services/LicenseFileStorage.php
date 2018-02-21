<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

class LicenseFileStorage implements ILicenseStorage
{

    public function getPermission($permissionId)
    {
        return '';
    }

    public function setPermission($permissionId, $arrayData)
    {

    }

    public function delPermission($permissionId)
    {

    }

    public function clearPermissions()
    {

    }
}