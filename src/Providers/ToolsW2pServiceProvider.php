<?php

namespace Omadonex\ToolsW2p\Providers;

use Omadonex\ToolsW2p\Commands\Publish;
use Omadonex\ToolsW2p\Commands\ServiceMake;
use Illuminate\Support\ServiceProvider;
use Omadonex\ToolsW2p\Http\Middleware\ApiProtect;

class ToolsW2pServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Publish::class,
                ServiceMake::class,
            ]);
        }

        $pathRoot = realpath(__DIR__.'/../..');

        $this->loadViewsFrom("$pathRoot/resources/views", 'toolsw2p');
        $this->loadTranslationsFrom("$pathRoot/resources/lang", 'toolsw2p');

        $this->publishes([
            "$pathRoot/resources/views" => resource_path('views/vendor/toolsw2p'),
        ], 'views');
        $this->publishes([
            "$pathRoot/resources/lang" => resource_path('lang/vendor/toolsw2p'),
        ], 'translations');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['router']->aliasMiddleware('apiProtect', ApiProtect::class);
    }
}
