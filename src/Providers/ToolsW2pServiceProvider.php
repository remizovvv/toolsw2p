<?php

namespace Omadonex\ToolsW2p\Providers;

use Omadonex\ToolsW2p\Commands\Publish;
use Omadonex\ToolsW2p\Commands\ServiceMake;
use Illuminate\Support\ServiceProvider;
use Omadonex\ToolsW2p\Interfaces\IModelRepository;
use Omadonex\ToolsW2p\Interfaces\IModelService;
use Omadonex\ToolsW2p\Interfaces\ModelRepository;
use Omadonex\ToolsW2p\Interfaces\ModelService;

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
        $this->app->bind(IModelRepository::class, ModelRepository::class);
        $this->app->bind(IModelService::class, ModelService::class);
    }
}
