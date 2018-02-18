<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface IModelService
{
    /**
     * Создает новую модель по введенным данным и возращает ее
     * @param $data
     * @return Model
     */
    public function create($data);

    /**
     * Обновляет поля модели и возвращает обновленную модель
     * @param $id
     * @param $data
     * @throws ModelNotFoundException
     * @return Model
     */
    public function update($id, $data);

    public function tryDestroy($id);
}