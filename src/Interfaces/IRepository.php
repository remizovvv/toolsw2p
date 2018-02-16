<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Omadonex\ToolsW2p\Classes\Exceptions\W2pModelNotFoundException;
use Omadonex\ToolsW2p\Classes\Exceptions\W2pModelNotUsesTraitException;

interface IRepository
{
    /**
     * Возвращает список доступных связей модели, либо пустой массив, если свойство отсутствует
     * @return array
     */
    public function getAvailableRelations();

    /**
     * Находит модель по id, загружая указанные связи и учитывая `active`
     * @param $id
     * @param bool|array $relations
     * @param bool|null $active
     * @throws W2pModelNotFoundException
     * @throws W2pModelNotUsesTraitException
     * @return Model
     */
    public function find($id, $relations = true, $active = null);

    /**
     * Получает коллекцию элементов, загружая указанные связи и учитывая `active`
     * Возвращает пагинатор либо коллекцию, если кол-во элементов не указано, то оно будет взято из модели
     * @param bool|array $relations
     * @param bool|null $active
     * @param bool|int $paginate
     * @throws W2pModelNotUsesTraitException
     * @return LengthAwarePaginator | Collection
     */
    public function list($relations = true, $active = null, $paginate = true);

    public function create($data);

    public function update($id, $data);
}