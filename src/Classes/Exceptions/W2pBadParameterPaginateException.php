<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 12.02.2018
 * Time: 13:16
 */

namespace Omadonex\ToolsW2p\Classes\Exceptions;

class W2pBadParameterPaginateException extends \Exception
{

    public function __construct()
    {
        $message = "Параметр `paginate` может принимать одно из следующих значений: " .
            "false | true | integer";
        parent::__construct($message);
    }
}