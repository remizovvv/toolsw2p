<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces\Subdomain;

interface ISubdomainSaveable
{
    public function saveToSubdomainStorage(ISubdomainStorage $storage);
}
