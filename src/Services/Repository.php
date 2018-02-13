<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

use Omadonex\ToolsW2p\Classes\Exceptions\ModelNotFoundException;

class Repository implements IRepository
{
    protected $model;

    protected function attachRelations($qb, $relations)
    {
        $prop = 'availableRelations';
        if (($relations === true)
            && property_exists(get_class($this->model), $prop)
            && is_array($this->model->$prop)) {
            $qb->with($this->model->$prop);
        }

        if (is_array($relations)) {
            $qb->with($relations);
        }

        return $qb;
    }

    public function getAvailableRelations()
    {
        return $this->model->availableRelations;
    }

    protected function getPaginateCount()
    {
        return $this->model->paginateCount;
    }

    public function find($id, $relations = true)
    {
        $qb = $this->model->query();
        $model = $this->attachRelations($qb, $relations)->find($id);

        if (is_null($model)) {
            throw new ModelNotFoundException($this->model, $id);
        }

        return $model;
    }

    public function all($relations = true)
    {
        $qb = $this->model->query();

        return $this->attachRelations($qb, $relations)->get();
    }

    public function paginate($relations = true, $paginateCount = null)
    {
        $qb = $this->model->query();

        return $this->attachRelations($qb, $relations)->paginate($paginateCount ?: $this->getPaginateCount());
    }
}