<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

use Omadonex\ToolsW2p\Classes\AppCustomConstants;
use Omadonex\ToolsW2p\Classes\Exceptions\ModelNotFoundException;
use Omadonex\ToolsW2p\Classes\Exceptions\ModelNotUsesTraitException;
use Omadonex\ToolsW2p\Traits\CanBeActivatedTrait;

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

    protected function getPaginateCount()
    {
        return $this->model->paginateCount ?: AppCustomConstants::DEFAULT_PAGINATE_COUNT;
    }

    private function makeQB($relations, $active)
    {
        if (!in_array(CanBeActivatedTrait::class, class_uses($this->model))) {
            throw new ModelNotUsesTraitException(get_class($this->model), CanBeActivatedTrait::class);
        }

        $qb = $this->model->query();
        if (!is_null($active)) {
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
            throw new ModelNotFoundException($this->model, $id);
        }

        return $model;
    }

    public function all($relations = true, $active = null)
    {
        return $this->makeQB($relations, $active)->get();
    }

    public function paginate($paginateCount = null, $relations = true, $active = null)
    {
        return $this->makeQB($relations, $active)->paginate($paginateCount ?: $this->getPaginateCount());
    }
}