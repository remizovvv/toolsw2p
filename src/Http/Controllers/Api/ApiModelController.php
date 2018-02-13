<?php

namespace Omadonex\ToolsW2p\Http\Controllers\Api;

use Illuminate\Http\Request;
use Omadonex\ToolsW2p\Classes\Exceptions\BadParameterActiveException;
use Omadonex\ToolsW2p\Classes\Exceptions\BadParameterRelationsException;
use Omadonex\ToolsW2p\Interfaces\IRepository;

class ApiModelController extends ApiBaseController
{
    protected $repo;
    protected $relations;
    protected $active;

    public function __construct(IRepository $repo, Request $request)
    {
        parent::__construct($request);
        $this->repo = $repo;
        $this->relations = $this->getParamRelations($request, $this->repo->getAvailableRelations());
        $this->active = $this->getParamActive($request);
    }

    private function getParamRelations(Request $request, $availableRelations)
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

    private function getParamActive(Request $request)
    {
        $data = $request->all();
        if (!array_key_exists('active', $data)) {
            return null;
        }

        if ($data['active'] === 'true') {
            return true;
        }

        if ($data['active'] === 'false') {
            return false;
        }

        throw new BadParameterActiveException;
    }

    protected function find($id)
    {
        return $this->repo->find($id, $this->relations, $this->active);
    }

    protected function all()
    {
        return $this->repo->all($this->relations, $this->active);
    }

    protected function paginate($paginateCount = null)
    {
        return $this->repo->paginate($paginateCount, $this->relations, $this->active);
    }
}