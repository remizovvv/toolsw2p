<?php

namespace Omadonex\ToolsW2p\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Omadonex\ToolsW2p\Traits\AppendsToApiResourceTrait;

class PaginateResourceCollection extends ResourceCollection
{
    use AppendsToApiResourceTrait;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
