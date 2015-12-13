<?php

namespace Coreproc\Enom\Facades;

use Illuminate\Support\Facades\Facade;

class Tld extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'enomtld';
    }

}