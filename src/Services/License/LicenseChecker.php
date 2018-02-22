<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 12.02.2018
 * Time: 15:42
 */

namespace Omadonex\ToolsW2p\Services\License;

use Omadonex\ToolsW2p\Interfaces\License\ILicenseChecker;
use Omadonex\ToolsW2p\Interfaces\License\ILicenseStorage;

class LicenseChecker implements ILicenseChecker
{
    protected $storage;

    public function __construct(ILicenseStorage $storage)
    {
        $this->storage = $storage;
    }

    public function check()
    {

    }
}