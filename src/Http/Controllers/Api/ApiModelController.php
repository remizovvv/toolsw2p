<?php

namespace Omadonex\ToolsW2p\Http\Controllers\Api;

use Illuminate\Http\Request;
use Omadonex\ToolsW2p\Classes\Exceptions\W2pBadParameterActiveException;
use Omadonex\ToolsW2p\Classes\Exceptions\W2pBadParameterPaginateException;
use Omadonex\ToolsW2p\Classes\Exceptions\W2pBadParameterRelationsException;
use Omadonex\ToolsW2p\Interfaces\IRepository;

class ApiModelController extends ApiBaseController
{
    protected $repo;
    protected $relations;
    protected $active;
    protected $paginate;

    public function __construct(IRepository $repo, Request $request)
    {
        parent::__construct($request);
        $this->repo = $repo;
        $this->relations = $this->getParamRelations($request, $this->repo->getAvailableRelations());
        $this->active = $this->getParamActive($request);
        $this->paginate = $this->getParamPaginate($request);
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

        throw new W2pBadParameterRelationsException($availableRelations);
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

        throw new W2pBadParameterActiveException;
    }

    private function getParamPaginate(Request $request)
    {
        $data = $request->all();
        if (!array_key_exists('paginate', $data) || ($data['paginate'] === 'true')) {
            return true;
        }

        if ($data['paginate'] === 'false') {
            return false;
        }

        if (is_numeric($data['paginate'])) {
            return $data['paginate'];
        }

        throw new W2pBadParameterPaginateException;
    }

    protected function find($id)
    {
        return $this->repo->find($id, $this->relations, $this->active);
    }

    protected function list()
    {
        return $this->repo->list($this->relations, $this->active, $this->paginate);
    }
}