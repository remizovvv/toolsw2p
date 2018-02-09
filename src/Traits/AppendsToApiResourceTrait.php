<?php

namespace Omadonex\ToolsW2p\Traits;

trait AppendsToApiResourceTrait
{
    public function with($request)
    {
        $data = $request->all();
        unset($data['page']);

        return [
            'appends' => $data,
        ];
    }
}
