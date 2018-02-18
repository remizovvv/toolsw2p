<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

abstract class ModelService implements IModelService
{
    protected $repo;

    public function __construct(IModelRepository $repo)
    {
        $this->repo = $repo;
    }

    public function create($data)
    {
        return $this->repo->getModel()->create($data);
    }

    public function update($id, $data)
    {
        $model = $this->repo->find($id);
        $model->update($data);

        return $model;
    }

    public function tryDestroy($id)
    {
        $this->repo->getModel()->destroy($id);
    }
}