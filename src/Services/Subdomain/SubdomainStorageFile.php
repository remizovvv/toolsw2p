<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Services\Subdomain;

use Omadonex\ToolsW2p\Interfaces\Subdomain\ISubdomainStorageBase;

class SubdomainStorageFile implements ISubdomainStorageBase
{
    protected $paths;

    public function __construct($paths)
    {
        $this->paths = $paths;
    }

    public function get($recordType, $key)
    {
        return '';
    }

    public function set($recordType, $key, $valueArr)
    {

    }

    public function remove($recordType, $key)
    {

    }

    public function clear($recordType = null)
    {

    }
}