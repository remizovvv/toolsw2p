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

    public function find($id, $relations = [], $fieldsStr = null)
    {
        $qb = $this->model->query();

        if (!empty($relations)) {
            $qb->with($relations);
        }

        return $qb->find($id);
    }

    public function all($relations = [], $limit = null, $offset = null)
    {
        $qb = $this->model->query();

        if (!empty($relations)) {
            $qb->with($relations);
        }

        if (!is_null($limit)) {
            $qb->limit($limit);
        }

        if (!is_null($offset)) {
            $qb->offset($offset);
        }

        return $qb->get();
    }
}