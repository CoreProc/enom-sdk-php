<?php

namespace Coreproc\Enom;

use Exception;

class EnomApiException extends Exception
{

    private $errors;

    public function __construct($errors = null)
    {
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}