<?php

namespace Coreproc\Enom\Providers;

use Coreproc\Enom\Enom;
use Illuminate\Support\ServiceProvider;

class EnomServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes(__DIR__ . '../../config/enom.php', config_path('enom.php'));
    }

    public function register()
    {
        $this->app->bind('enom', function () {
            return new Enom(config('enom.userId'), config('enom.password'));
        });
    }

}