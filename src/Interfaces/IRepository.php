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
    public function find($id, $relations = []);

    public function all($relations = []);

    public function paginate($paginateCount, $relations = []);
}