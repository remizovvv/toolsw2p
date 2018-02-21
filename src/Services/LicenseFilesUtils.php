<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

class LicenseFilesUtils implements ILicenseFilesUtils
{
    protected $memStorage;

    public function __construct(ILicenseFilesMemStorage $memStorage)
    {
        $this->memStorage = $memStorage;
    }

    public function addPermissionRecord($data)
    {
        $id = $data['id'];
        unset($data['id']);
        //TODO Write to Yaml file
        $this->memStorage->setPermission($id, $data);
    }

    public function clearPermissions()
    {
        //TODO Delete Yaml file
        $this->memStorage->delPermission();
    }
}