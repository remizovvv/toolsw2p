<?php

namespace Omadonex\ToolsW2p\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Routing\Controller;
use Omadonex\ToolsW2p\Classes\Utils\ResponseJsonUtils;

class ApiBaseController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function okResponse($data = [])
    {
        $finalData = $data;
        if (($data instanceof Resource) || ($data instanceof ResourceCollection)) {
            $finalData = $data->toResponse($this->request)->getData();
        }
        return ResponseJsonUtils::okResponse($finalData);
    }

    protected function errorResponse($errorMsg = '')
    {
        return ResponseJsonUtils::errorResponse($errorMsg);
    }
}