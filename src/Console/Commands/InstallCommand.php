<?php

namespace Patrixsmart\Skyriver\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'skyriver:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishes all necessary user editable files';

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
     * @return int
     */
    public function handle()
    {
        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers/Skyriver'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/app/Http/Controllers', app_path('Http/Controllers/Skyriver'));

        // Routes...
        (new Filesystem)->ensureDirectoryExists(base_path('routes/skyriver'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/routes', base_path('routes/skyriver'));

        return 0;
    }
}
