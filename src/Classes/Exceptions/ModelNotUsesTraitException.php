<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 12.02.2018
 * Time: 13:16
 */

namespace Omadonex\ToolsW2p\Classes\Exceptions;

class ModelNotUsesTraitException extends \Exception
{
    public function __construct($modelName, $traitName)
    {
        $message = "Модель `$modelName` не использует trait `$traitName`";
        parent::__construct($message);
    }
}