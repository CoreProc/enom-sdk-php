<?php

namespace Coreproc\Enom\Facades;

use Illuminate\Support\Facades\Facade;

class Enom extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'enom';
    }

}