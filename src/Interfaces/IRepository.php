<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 06.02.2018
 * Time: 21:34
 */

namespace Omadonex\ToolsW2p\Interfaces;

interface IRepository
{
    public function find($id, $relations = true);

    public function all($relations = true);

    public function paginate($paginateCount, $relations = true);
}