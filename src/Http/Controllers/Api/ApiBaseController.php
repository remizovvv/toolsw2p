<?php

namespace Omadonex\ToolsW2p\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Omadonex\ToolsW2p\Classes\Exceptions\BadParameterRelationsException;
use Omadonex\ToolsW2p\Classes\Utils\ResponseJsonUtils;
use Omadonex\ToolsW2p\Interfaces\IRepository;

class ApiBaseController extends Controller
{
    protected function okResponse($data)
    {
        return ResponseJsonUtils::okResponse($data);
    }

    protected function errorResponse($data)
    {
        return ResponseJsonUtils::errorResponse($data);
    }
}