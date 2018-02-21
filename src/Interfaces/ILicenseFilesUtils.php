<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

interface ILicenseFilesUtils
{
    public function addTypoRecord($data);

    public function updateTypoRecord($host, $data);

    public function deleteTypoRecord($host);

    public function addLicenseRecord($data);

    public function addPermissionRecord($data);
}