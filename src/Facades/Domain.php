<?php

namespace Coreproc\Enom\Facades;

use Illuminate\Support\Facades\Facade;

class Domain extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'domain';
    }

}