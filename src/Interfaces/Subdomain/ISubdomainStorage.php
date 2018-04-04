<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces\Subdomain;

interface ISubdomainStorage extends ISubdomainStorageBase
{
    public function clearLicenses();

    public function clearPermissions();

    public function clearTypographies();

    public function getLicense($key);

    public function getPermission($key);

    public function getTypography($key);

    public function removeLicense($key);

    public function removePermission($key);

    public function removeTypography($key);

    public function setLicense($key, $valueArr);

    public function setPermission($key, $valueArr);

    public function setTypography($key, $valueArr);
}