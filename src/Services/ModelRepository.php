<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Omadonex\ToolsW2p\Classes\Exceptions\W2pModelNotFoundException;
use Omadonex\ToolsW2p\Classes\Exceptions\W2pModelNotUsesTraitException;
use Omadonex\ToolsW2p\Traits\CanBeActivatedTrait;
use Omadonex\ToolsW2p\Transformers\PaginateResourceCollection;

abstract class ModelRepository implements IModelRepository
{
    const TRASHED_WITH = 'with';
    const TRASHED_ONLY = 'only';

    protected $model;
    protected $modelClass;
    protected $resourceClass;

    public function __construct(Model $model, $resourceClass)
    {
        $this->model = $model;
        $this->modelClass = get_class($model);
        $this->resourceClass = $resourceClass;
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

    private function makeQB($relations, $trashed, $active)
    {
        $qb = $this->model->query();

        if (!is_null($trashed)) {
            if (!in_array(SoftDeletes::class, class_uses($this->modelClass))) {
                throw new W2pModelNotUsesTraitException($this->modelClass, SoftDeletes::class);
            }

            if ($trashed === self::TRASHED_WITH) {
                $qb->withTrashed();
            }

            if ($trashed === self::TRASHED_ONLY) {
                $qb->onlyTrashed();
            }
        }

        if (!is_null($active)) {
            if (!in_array(CanBeActivatedTrait::class, class_uses($this->modelClass))) {
                throw new W2pModelNotUsesTraitException($this->modelClass, CanBeActivatedTrait::class);
            }
            $qb->byActive($active);
        }

        return $this->attachRelations($qb, $relations);
    }

    private function getResourceCollection($paginate, $collection)
    {
        if ($paginate) {
            return new PaginateResourceCollection($collection, $this->resourceClass);
        }

        return $this->resourceClass::collection($collection);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getAvailableRelations()
    {
        return $this->model->availableRelations ?: [];
    }

    public function find($id, $relations = true, $trashed = null)
    {
        $model = $this->makeQB($relations, $trashed, null)->find($id);

        if (is_null($model)) {
            throw new W2pModelNotFoundException($this->model, $id);
        }

        return $model;
    }

    public function findResource($id, $relations = true, $trashed = null)
    {
        return new $this->resourceClass($this->find($id, $relations, $trashed));
    }

    public function list($relations = true, $trashed = null, $active = null, $paginate = true)
    {
        $qb = $this->makeQB($relations, $trashed, $active);

        return (!$paginate) ? $qb->get() : $qb->paginate(($paginate === true) ? $this->model->getPerPage() : $paginate);
    }

    public function listResource($relations = true, $trashed = null, $active = null, $paginate = true)
    {
        return $this->getResourceCollection($paginate, $this->list($relations, $trashed, $active, $paginate));
    }
}