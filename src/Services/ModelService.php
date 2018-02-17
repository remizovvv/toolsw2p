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

class ModelService implements IModelService
{
    protected $model;
    protected $modelClass;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->modelClass = get_class($model);
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