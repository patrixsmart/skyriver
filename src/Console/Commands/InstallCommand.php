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
    protected $signature = 'skyriver:install
    {--P|passport=true : Install all the files needed to generate api token with passport}
    {--S|socialite}=true : Install all the files needed for social authentication using socialite';

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

        // Base Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers/Skyriver'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/app/Http/Controllers/Base', app_path('Http/Controllers/Skyriver'));

        // Config...
        (new Filesystem)->ensureDirectoryExists(base_path('config'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../config', base_path('config'));

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


        if($this->option('socialite')){
            $this->newLine();
            $this->line('Trying to install neccessary files needed for socialite');
            $this->newLine();
            $this->socialite();
            $this->newLine();
            $this->info('Skyriver socialite files installed successfully.');
        }

        if($this->option('passport')){
            $this->newLine();
            $this->line('Trying to install neccessary files needed for passport');
            $this->newLine();
            $this->passport();
            $this->newLine();
            $this->info('Skyriver passport files installed successfully.');
            $this->newLine();
        }


        $this->line('We are migrating all necessary tables needed for skyriver');
        $this->call('migrate');
        $this->info('Skyriver tables migrated successfully.');

        $this->info('Skyriver scaffolding installed successfully.');
    }

    private function socialite()
    {
        // Migrations...
        (new Filesystem)->ensureDirectoryExists(base_path('database/migrations'));
        (new Filesystem)->copyDirectory(
            __DIR__.'/../../../stubs/database/migrations',
            base_path('database/migrations')
        );

        // Traits
        (new Filesystem)->ensureDirectoryExists(app_path('Traits/Skyriver/Socialite'));
        (new Filesystem)->copyDirectory(
            __DIR__.'/../../../stubs/app/Traits/Socialite',
            app_path('Traits/Skyriver/Socialite')
        );

        // Actions...
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/Skyriver/Socialite'));
        (new Filesystem)->copyDirectory(
            __DIR__.'/../../../stubs/app/Actions/Socialite',
            app_path('Actions/Skyriver/Socialite')
        );

        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers/Skyriver/Socialite'));
        (new Filesystem)->copyDirectory(
            __DIR__.'/../../../stubs/app/Http/Controllers/Socialite',
            app_path('Http/Controllers/Skyriver/Socialite')
        );

        // Models
        (new Filesystem)->ensureDirectoryExists(app_path('Models/Skyriver/Socialite'));
        (new Filesystem)->copyDirectory(
            __DIR__.'/../../../stubs/app/Models/Socialite',
            app_path('Models/Skyriver/Socialite')
        );

    }

    private function passport()
    {
        // Actions...
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/Skyriver/Passport'));
        (new Filesystem)->copyDirectory(
            __DIR__.'/../../../stubs/app/Actions/Passport',
            app_path('Actions/Skyriver/Passport')
        );

        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers/Skyriver/Passport'));
        (new Filesystem)->copyDirectory(
            __DIR__.'/../../../stubs/app/Http/Controllers/Passport',
            app_path('Http/Controllers/Skyriver/Passport')
        );

        // Models
        (new Filesystem)->ensureDirectoryExists(app_path('Models/Skyriver/Passport'));
        (new Filesystem)->copyDirectory(
            __DIR__.'/../../../stubs/app/Models/Passport',
            app_path('Models/Skyriver/Passport')
        );
    }
}
