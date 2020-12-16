<?php

namespace Patrixsmart\Skyriver;

use Illuminate\Support\ServiceProvider;
use Patrixsmart\Skyriver\Console\Commands\InstallCommand;

class SkyriverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/skyriver.php', 'skyriver'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/skyriver.php' => config_path('skyriver.php')
        ],'skyriver-config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class
            ]);
        }
    }
}
