<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Omadonex\ToolsW2p\Classes\Exceptions\W2pModelNotFoundException;
use Omadonex\ToolsW2p\Classes\Exceptions\W2pModelNotUsesTraitException;
use Omadonex\ToolsW2p\Traits\CanBeActivatedTrait;

class Repository implements IRepository
{
    protected $model;
    protected $modelClass;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->modelClass = get_class($model);
    }

    protected function attachRelations($qb, $relations)
    {
        $prop = 'availableRelations';
        if (($relations === true)
            && property_exists($this->modelClass, $prop)
            && is_array($this->model->$prop)) {
            $qb->with($this->model->$prop);
        }

        if (is_array($relations)) {
            $qb->with($relations);
        }

        return $qb;
    }

    private function makeQB($relations, $active)
    {
        $qb = $this->model->query();
        if (!is_null($active)) {
            if (!in_array(CanBeActivatedTrait::class, class_uses($this->modelClass))) {
                throw new W2pModelNotUsesTraitException($this->modelClass, CanBeActivatedTrait::class);
            }
            $qb->byActive($active);
        }

        return $this->attachRelations($qb, $relations);
    }

    public function getAvailableRelations()
    {
        return $this->model->availableRelations ?: [];
    }

    public function find($id, $relations = true, $active = null)
    {
        $model = $this->makeQB($relations, $active)->find($id);

        if (is_null($model)) {
            throw new W2pModelNotFoundException($this->model, $id);
        }

        return $model;
    }

    public function list($relations = true, $active = null, $paginate = true)
    {
        $qb = $this->makeQB($relations, $active);
        return (!$paginate) ? $qb->get() : $qb->paginate(($paginate === true) ? $this->model->getPerPage() : $paginate);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $model = $this->model->find($id);
        if (is_null($model)) {
            throw new W2pModelNotFoundException($this->model, $id);
        }
        $model->update($data);

        return $model;
    }
}