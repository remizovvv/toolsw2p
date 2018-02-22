<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 12.02.2018
 * Time: 15:42
 */

namespace Omadonex\ToolsW2p\Services\Licenser;

use Omadonex\ToolsW2p\Interfaces\Licenser\ILicenser;
use Omadonex\ToolsW2p\Interfaces\Licenser\ILicenserStorage;

class Licenser implements ILicenser
{
    protected $storage;

    public function __construct(ILicenserStorage $storage)
    {
        $this->storage = $storage;
    }

    public function check()
    {

    }
}