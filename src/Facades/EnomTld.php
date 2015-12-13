<?php

namespace Coreproc\Enom\Facades;

use Illuminate\Support\Facades\Facade;

class EnomTld extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'enomtld';
    }

}