<?php

namespace Coreproc\Enom;

class Enom
{
    public $userId;
    public $password;

    public function __construct($userId, $password)
    {
        $this->userId = $userId;
        $this->password = $password;
    }
}