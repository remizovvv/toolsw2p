<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

class Repository implements IRepository
{
    protected $model;

    protected function attachRelations($qb, $relations = [])
    {
        if (!empty($relations)) {
            $qb->with($relations);
        }

        return $qb;
    }

    public function find($id, $relations = [])
    {
        $qb = $this->model->query();

        return $this->attachRelations($qb, $relations)->find($id);
    }

    public function all($relations = [])
    {
        $qb = $this->model->query();

        return $this->attachRelations($qb, $relations)->get();
    }

    public function paginate($count, $relations = [])
    {
        $qb = $this->model->query();

        return $this->attachRelations($qb, $relations)->paginate($count);
    }
}