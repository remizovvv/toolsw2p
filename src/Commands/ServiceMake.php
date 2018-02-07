<?php

namespace Omadonex\ToolsW2p\Commands;

use Illuminate\Console\Command;

class ServiceMake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new inner service for application';

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
        $this->info('created');
    }
}
