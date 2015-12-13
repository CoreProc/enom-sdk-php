<?php

namespace Coreproc\Enom\Accessors;

use Coreproc\Enom\EnomAccessor;
use Exception;

class Customer extends EnomAccessor
{

    public function updatePreferences(array $params)
    {
        try {
            return $this->enom->call('UpdateCusPreferences', $params);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getPreferences()
    {
        try {
            return $this->enom->call('GetCusPreferences');
        } catch (Exception $e) {
            throw $e;
        }
    }

}