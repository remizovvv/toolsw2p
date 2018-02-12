<?php

namespace Omadonex\ToolsW2p\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Omadonex\ToolsW2p\Classes\Exceptions\BadParameterRelationsException;

class ApiBaseController extends Controller
{
    protected function getRelations(Request $request, $availableRelations)
    {
        $data = $request->all();
        if (!array_key_exists('relations', $data) || ($data['relations'] === 'true')) {
            return true;
        }

        if ($data['relations'] === 'false') {
            return false;
        }

        if (is_array($data['relations']) && empty(array_diff($data['relations'], $availableRelations))) {
            return $data['relations'];
        }

        throw new BadParameterRelationsException($availableRelations);
    }
}
