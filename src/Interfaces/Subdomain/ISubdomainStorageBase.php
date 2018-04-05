<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces\Subdomain;

interface ISubdomainStorageBase
{
    public function get($recordType, $key);

    public function set($recordType, $key, $valueArr);

    public function remove($recordType, $key);

    public function clear($recordType = null);
}