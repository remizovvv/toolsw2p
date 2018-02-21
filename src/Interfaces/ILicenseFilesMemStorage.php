<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

interface ILicenseFilesMemStorage
{
    //public function getTypo($host);

    //public function setTypo($host, $data);

    //public function getLicense($licenseId);

    //public function setLicense($licenseId);

    public function getPermission($permissionId);

    public function setPermission($permissionId, $value);

    public function delPermission($permissionId);
}