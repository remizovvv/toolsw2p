<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Services\Model;

use Omadonex\ToolsW2p\Classes\Exceptions\W2pModelCanNotBeActivatedException;
use Omadonex\ToolsW2p\Classes\Exceptions\W2pModelCanNotBeDeactivatedException;
use Omadonex\ToolsW2p\Classes\Exceptions\W2pModelNotUsesTraitException;
use Omadonex\ToolsW2p\Interfaces\Model\IModelRepository;
use Omadonex\ToolsW2p\Interfaces\Model\IModelService;
use Omadonex\ToolsW2p\Traits\CanBeActivatedTrait;

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

    public function destroy($id)
    {
        $this->repo->getModel()->destroy($id);
    }

    public function tryDestroy($id)
    {
        $this->destroy($id);
    }

    public function activate($id)
    {
        $modelClass = get_class($this->repo->getModel());
        if (!in_array(CanBeActivatedTrait::class, class_uses($modelClass))) {
            throw new W2pModelNotUsesTraitException($modelClass, CanBeActivatedTrait::class);
        }

        $model = $this->repo->find($id);
        if (!$model->canActivate()) {
             throw new W2pModelCanNotBeActivatedException($this->repo->getModel()->cantActivateText());
        }

        $model->activate();
    }

    public function deactivate($id)
    {
        $modelClass = get_class($this->repo->getModel());
        if (!in_array(CanBeActivatedTrait::class, class_uses($modelClass))) {
            throw new W2pModelNotUsesTraitException($modelClass, CanBeActivatedTrait::class);
        }

        $model = $this->repo->find($id);
        if (!$model->canDeactivate()) {
            throw new W2pModelCanNotBeDeactivatedException($this->repo->getModel()->cantDeactivateText());
        }

        $model->deactivate();
    }
}