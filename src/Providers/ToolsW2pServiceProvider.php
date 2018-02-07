<?php

namespace Omadonex\ToolsW2p\Providers;

use Omadonex\ToolsW2p\Commands\Publish;
use Omadonex\ToolsW2p\Commands\ServiceMake;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
