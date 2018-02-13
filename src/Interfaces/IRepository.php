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
use Omadonex\ToolsW2p\Classes\Exceptions\ModelNotFoundException;
use Omadonex\ToolsW2p\Classes\Exceptions\ModelNotUsesTraitException;

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
     * @throws ModelNotFoundException
     * @throws ModelNotUsesTraitException
     * @return Model
     */
    public function find($id, $relations = true, $active = null);

    /**
     * Возвращает коллекцию всех моделей, загружая указанные связи и учитывая `active`
     * @param bool|array $relations
     * @param bool|null $active
     * @throws ModelNotUsesTraitException
     * @return Collection
     */
    public function all($relations = true, $active = null);

    /**
     * Получает коллекцию элементов, загружая указанные связи и учитывая `active`
     * Возвращает пагинатор, если кол-во элементов не указано, то оно будет взято из модели, либо из глобальных констант
     * @param null|int $paginateCount
     * @param bool|array $relations
     * @param bool|null $active
     * @throws ModelNotUsesTraitException
     * @return LengthAwarePaginator
     */
    public function paginate($paginateCount = null, $relations = true, $active = null);
}