<?php

namespace Coreproc\Enom;

class EnomAccessor
{

    protected $enom;

    public function __construct(Enom $enom)
    {
        $this->enom = $enom;
    }

}