<?php

namespace Patrixsmart\Skyriver;

use Illuminate\Support\ServiceProvider;

class SkyriverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/skyriver.php' => config_path('skyriver.php'),
        ]);
    }
}
