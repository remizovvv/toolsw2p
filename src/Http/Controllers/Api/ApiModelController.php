<?php

namespace Omadonex\ToolsW2p\Http\Controllers\Api;

use Illuminate\Http\Request;
use Omadonex\ToolsW2p\Classes\Exceptions\BadParameterRelationsException;
use Omadonex\ToolsW2p\Interfaces\IRepository;

class ApiModelController extends ApiBaseController
{
    protected $repo;
    protected $relations;

    public function __construct(IRepository $repo, Request $request)
    {
        $this->repo = $repo;
        $this->relations = $this->getRelations($request, $this->repo->getAvailableRelations());
    }

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