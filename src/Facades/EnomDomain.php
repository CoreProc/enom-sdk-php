<?php

namespace Coreproc\Enom\Facades;

use Illuminate\Support\Facades\Facade;

class EnomDomain extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'enomdomain';
    }

}