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
        return $this->repo->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->repo->getModel()->destroy($id);
    }

    public function tryDestroy($id)
    {
        return $this->destroy($id);
    }
}