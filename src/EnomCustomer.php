<?php

namespace Coreproc\Enom;

use Exception;

class EnomCustomer
{

    /**
     * @var Enom
     */
    private $enom;

    public function __construct(Enom $enom)
    {
        $this->enom = $enom;
    }

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