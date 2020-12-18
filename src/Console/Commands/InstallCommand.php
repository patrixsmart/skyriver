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
        // Actions...
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/Skyriver'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/app/Actions', app_path('Actions/Skyriver'));

        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers/Skyriver'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/app/Http/Controllers', app_path('Http/Controllers/Skyriver'));

        // Factories...
        (new Filesystem)->ensureDirectoryExists(base_path('database/factories/skyriver/socialite'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/database/factories/socialite', base_path('database/factories/skyriver/socialite'));

        // Migrations...
        (new Filesystem)->ensureDirectoryExists(base_path('database/migrations'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/database/migrations', base_path('database/migrations'));

        // Models
        (new Filesystem)->ensureDirectoryExists(app_path('Models/Skyriver'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/app/Models', app_path('Models/Skyriver'));

        // Requests...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests/Skyriver'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/app/Http/Requests', app_path('Http/Requests/Skyriver'));

        // Providers
        (new Filesystem)->ensureDirectoryExists(app_path('Providers'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/app/Providers', app_path('Providers'));

        // Rules
        (new Filesystem)->ensureDirectoryExists(app_path('Rules/Skyriver'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/app/Rules', app_path('Rules/Skyriver'));

        // Routes...
        (new Filesystem)->ensureDirectoryExists(base_path('routes/skyriver'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/routes', base_path('routes/skyriver'));

        // Seeders...
        (new Filesystem)->ensureDirectoryExists(base_path('database/seeders/skyriver/socialite'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/database/seeders/socialite', base_path('database/seeders/skyriver/socialite'));

        // Traits
        (new Filesystem)->ensureDirectoryExists(app_path('Traits/Skyriver'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/app/Traits', app_path('Traits/Skyriver'));

        $this->info('Skyriver scaffolding installed successfully.');
    }
}
