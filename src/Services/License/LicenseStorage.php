<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 12.02.2018
 * Time: 15:42
 */

namespace Omadonex\ToolsW2p\Services\License;

use Omadonex\ToolsW2p\Classes\AppConstants;
use Omadonex\ToolsW2p\Interfaces\License\ILicenseStorage;

class LicenseStorage implements ILicenseStorage
{
    const STORAGE_TYPE_FILE = 'file';
    const STORAGE_TYPE_REDIS = 'redis';

    protected $storageFile;
    protected $storageRedis;
    protected $preferReadStorage;

    public function __construct($paths, $redisConnection)
    {
        $this->storageFile = new LicenseStorageFile($paths);
        $this->storageRedis = new LicenseStorageRedis($redisConnection);
        $this->preferReadStorage = self::STORAGE_TYPE_REDIS;
    }

    private function getPreferReadStorage()
    {
        if ($this->preferReadStorage === self::STORAGE_TYPE_FILE) {
            return $this->storageFile;
        }

        return $this->storageRedis;
    }

    public function setPreferReadStorage($storageType)
    {
        $this->preferReadStorage = $storageType;
    }

    public function get($recordType, $key)
    {
        return $this->getPreferReadStorage()->get($recordType, $key);
    }

    public function set($recordType, $key, $valueArr)
    {
        $this->storageFile->set($recordType, $key, $valueArr);
        $this->storageRedis->set($recordType, $key, $valueArr);
    }

    public function remove($recordType, $key)
    {
        $this->storageFile->remove($recordType, $key);
        $this->storageRedis->remove($recordType, $key);
    }

    public function clear($recordType)
    {
        $this->storageFile->clear($recordType);
        $this->storageRedis->clear($recordType);
    }

    public function clearLicenses()
    {
        $this->clear(AppConstants::LICENSE_RECORD_TYPE_LICENSE);
    }

    public function clearPermissions()
    {
        $this->clear(AppConstants::LICENSE_RECORD_TYPE_PERMISSION);
    }

    public function clearTypographies()
    {
        $this->clear(AppConstants::LICENSE_RECORD_TYPE_TYPOGRAPHY);
    }

    public function getLicense($key)
    {
        return $this->get(AppConstants::LICENSE_RECORD_TYPE_LICENSE, $key);
    }

    public function getPermission($key)
    {
        return $this->get(AppConstants::LICENSE_RECORD_TYPE_PERMISSION, $key);
    }

    public function getTypography($key)
    {
        return $this->get(AppConstants::LICENSE_RECORD_TYPE_TYPOGRAPHY, $key);
    }

    public function removeLicense($key)
    {
        $this->remove(AppConstants::LICENSE_RECORD_TYPE_LICENSE, $key);
    }

    public function removePermission($key)
    {
        $this->remove(AppConstants::LICENSE_RECORD_TYPE_PERMISSION, $key);
    }

    public function removeTypography($key)
    {
        $this->remove(AppConstants::LICENSE_RECORD_TYPE_TYPOGRAPHY, $key);
    }

    public function setLicense($key, $valueArr)
    {
        $this->set(AppConstants::LICENSE_RECORD_TYPE_LICENSE, $key, $valueArr);
    }

    public function setPermission($key, $valueArr)
    {
        $this->set(AppConstants::LICENSE_RECORD_TYPE_PERMISSION, $key, $valueArr);
    }

    public function setTypography($key, $valueArr)
    {
        $this->set(AppConstants::LICENSE_RECORD_TYPE_TYPOGRAPHY, $key, $valueArr);
    }
}