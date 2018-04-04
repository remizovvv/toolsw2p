<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 12.02.2018
 * Time: 15:42
 */

namespace Omadonex\ToolsW2p\Services\Subdomain;

use Omadonex\ToolsW2p\Interfaces\Subdomain\ISubdomainLicenseChecker;
use Omadonex\ToolsW2p\Interfaces\Subdomain\ISubdomainStorage;

class SubdomainLicenseChecker implements ISubdomainLicenseChecker
{
    protected $storage;

    public function __construct(ISubdomainStorage $storage)
    {
        $this->storage = $storage;
    }

    public function check()
    {

    }
}