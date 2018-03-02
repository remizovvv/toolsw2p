<?php

namespace Omadonex\ToolsW2p\Http\Middleware;

use Closure;

class ApiProtect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $actions = $request->route()->getAction();
        $routeProtected = !array_key_exists('apiProtect', $actions) || ($actions['apiProtect'] !== false);

        if (!$routeProtected) {
            return $next($request);
        }

        dd($request->api_token);

        return $next($request);
    }
}
