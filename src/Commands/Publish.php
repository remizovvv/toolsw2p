<?php

namespace Omadonex\ToolsW2p\Commands;

use Illuminate\Console\Command;

class Publish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tools:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishing common settings';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pathRoot = realpath(__DIR__.'/../..');
        copy("$pathRoot/config/modules.php", config_path('modules.php'));
        $this->info('copied');
    }
}
