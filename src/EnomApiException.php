<?php

namespace Coreproc\Enom;

use Exception;

class EnomApiException extends Exception
{

    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}