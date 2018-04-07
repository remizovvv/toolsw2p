<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 12.02.2018
 * Time: 15:42
 */

namespace Omadonex\ToolsW2p\Services\Subdomain;

use Omadonex\ToolsW2p\Classes\AppConstants;
use Omadonex\ToolsW2p\Interfaces\Subdomain\ISubdomainStorage;

class SubdomainStorage implements ISubdomainStorage
{
    /*
     * Тут немного непонятно для чего нам нужно все эти данные хранить дополнительно в файле, если мы из в любом
     * случае загружаем из Redis, может конечно произойти какая нибудь жесть на серваке и Redis затрется, но
     * тогда можно его перезаполнить, например, с помощью artisan команды
     * //TODO omadonex: подумать, оставлять файловый вариант или нет
     */

    const STORAGE_TYPE_FILE = 'file';
    const STORAGE_TYPE_REDIS = 'redis';

    protected $storageFile;
    protected $storageRedis;
    protected $preferReadStorage;

    public function __construct($paths, $redisConnection, $preferReadStorage = self::STORAGE_TYPE_REDIS)
    {
        $this->storageFile = new SubdomainStorageFile($paths);
        $this->storageRedis = new SubdomainStorageRedis($redisConnection);
        $this->preferReadStorage = $preferReadStorage;
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

    public function clear($recordType = null)
    {
        if ($recordType) {
            $this->storageFile->clear($recordType);
            $this->storageRedis->clear($recordType);
        } else {
            $this->clearLicenses();
            $this->clearPermissions();
            $this->clearTypographies();
        }
    }

    public function clearLicenses()
    {
        $this->clear(AppConstants::SUBDOMAIN_RECORD_TYPE_LICENSE);
    }

    public function clearPermissions()
    {
        $this->clear(AppConstants::SUBDOMAIN_RECORD_TYPE_PERMISSION);
    }

    public function clearTypographies()
    {
        $this->clear(AppConstants::SUBDOMAIN_RECORD_TYPE_TYPOGRAPHY);
        $this->clearAliases();
    }

    public function clearAliases($typographyKey = null)
    {
        if (!$typographyKey) {
            $this->clear(AppConstants::SUBDOMAIN_RECORD_TYPE_ALIAS);
        } else {
            $typographyInfo = $this->getTypography($typographyKey);
            if ($typographyInfo) {
                foreach ($typographyInfo['aliases'] as $aliasKey) {
                    $this->removeAlias($aliasKey);
                }
            }
        }
    }

    public function getLicense($key)
    {
        return $this->get(AppConstants::SUBDOMAIN_RECORD_TYPE_LICENSE, $key);
    }

    public function getPermission($key)
    {
        return $this->get(AppConstants::SUBDOMAIN_RECORD_TYPE_PERMISSION, $key);
    }

    public function getTypography($key)
    {
        return $this->get(AppConstants::SUBDOMAIN_RECORD_TYPE_TYPOGRAPHY, $key);
    }

    public function getTypographyByAlias($key)
    {
        $typographyKey = $this->get(AppConstants::SUBDOMAIN_RECORD_TYPE_ALIAS, $key);

        return $this->get(AppConstants::SUBDOMAIN_RECORD_TYPE_TYPOGRAPHY, $typographyKey);
    }

    public function removeLicense($key)
    {
        $this->remove(AppConstants::SUBDOMAIN_RECORD_TYPE_LICENSE, $key);
    }

    public function removePermission($key)
    {
        $this->remove(AppConstants::SUBDOMAIN_RECORD_TYPE_PERMISSION, $key);
    }

    public function removeTypography($key)
    {
        $this->clearAliases($key);
        $this->remove(AppConstants::SUBDOMAIN_RECORD_TYPE_TYPOGRAPHY, $key);
    }

    public function removeAlias($key)
    {
        $this->remove(AppConstants::SUBDOMAIN_RECORD_TYPE_ALIAS, $key);
    }

    public function setLicense($key, $valueArr)
    {
        $this->set(AppConstants::SUBDOMAIN_RECORD_TYPE_LICENSE, $key, $valueArr);
    }

    public function setPermission($key, $valueArr)
    {
        $this->set(AppConstants::SUBDOMAIN_RECORD_TYPE_PERMISSION, $key, $valueArr);
    }

    public function setTypography($key, $valueArr)
    {
        $this->set(AppConstants::SUBDOMAIN_RECORD_TYPE_TYPOGRAPHY, $key, $valueArr);
    }

    public function setAlias($key, $typographyKey)
    {
        $this->set(AppConstants::SUBDOMAIN_RECORD_TYPE_ALIAS, $key, $typographyKey);
    }
}