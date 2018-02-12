<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 12.02.2018
 * Time: 15:42
 */

namespace Omadonex\ToolsW2p\Classes\Utils;

class ResponseJsonUtils
{
    const CODE_OK = 200;
    const CORE_ERROR = 422;

    public static function okResponse($data)
    {
        return response()->json([
            'status' => true,
            'data' => $data,
        ], self::CODE_OK);
    }

    public static function errorResponse($errorMsg)
    {
        return response()->json([
            'status' => false,
            'data' => $errorMsg,
        ], self::CORE_ERROR);
    }
}