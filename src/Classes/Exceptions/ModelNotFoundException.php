<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 12.02.2018
 * Time: 13:16
 */

namespace Omadonex\ToolsW2p\Classes\Exceptions;

class ModelNotFoundException extends \Exception
{
    protected $modelClass;
    protected $id;

    public function __construct($modelClass, $id)
    {
        $this->modelClass = $modelClass;
        $this->id = $id;
        $message = "Модель `$modelClass` (id: $id) не найдена";
        parent::__construct($message);
    }
}