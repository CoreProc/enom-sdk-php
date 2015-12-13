<?php

namespace Coreproc\Enom\Providers;

use Coreproc\Enom\Enom;
use Coreproc\Enom\EnomDomain;
use Coreproc\Enom\EnomTld;
use Illuminate\Support\ServiceProvider;

class EnomServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            dirname(__DIR__) . '/../config/enom.php' => config_path('enom.php')
        ]);
    }

    public function register()
    {
        $enom = new Enom(config('enom.userId'), config('enom.password'), config('enom.develop', false));

        $this->app->bind('enomtld', function () use ($enom) {
            return new EnomTld($enom);
        });

        $this->app->bind('enomdomain', function () use ($enom) {
            return new EnomDomain($enom);
        });
    }

}