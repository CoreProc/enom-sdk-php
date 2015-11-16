<?php

namespace Coreproc\Enom;

use GuzzleHttp\Client;

class Enom
{

    protected $client;

    public function __construct($userId, $password)
    {
        $this->client = new Client([
            'base_url' => 'https://resellertest.enom.com/interface.asp',
            'defaults' => [
                "query" => [
                    'uid'          => $userId,
                    'pw'           => $password,
                    'responsetype' => 'xml'
                ]
            ]
        ]);
    }

    public function getClient()
    {
        return $this->client;
    }
}