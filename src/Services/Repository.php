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

    public function find($id, $relations = [])
    {
        $qb = $this->model->query();

        if (!empty($relations)) {
            $qb = $qb->with($relations);
        }

        if (is_array($id)) {
            return $qb->whereIn('id', $id)->get();
        }

        return $qb->find($id);
    }

    public function all($relations = [], $limit = null, $offset = null)
    {
        $qb = $this->model->query();

        return $qb->all();
    }
}