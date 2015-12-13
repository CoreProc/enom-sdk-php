<?php

namespace Coreproc\Enom;

use GuzzleHttp\Client;

class Enom
{

    protected $client;

    protected $userId;

    protected $password;

    protected $baseUrl;

    public function __construct($userId, $password, $test = false)
    {
        $this->userId = $userId;
        $this->password = $password;

        $this->baseUrl = 'https://reseller.enom.com/interface.asp';

        if ($test) {
            $this->baseUrl = 'https://resellertest.enom.com/interface.asp';
        }
    }

    /**
     * Grab the default Guzzle client for this API
     *
     * @return Client
     */
    public function getClient()
    {
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'query'    => [
                'uid'          => $this->userId,
                'pw'           => $this->password,
                'responsetype' => 'xml'
            ]
        ]);

        return $this->client;
    }

    private function doGetRequest($command, $additionalParams = [])
    {
        $params = [
            'command' => $command,
        ];

        if (count($additionalParams)) {
            $params = array_merge($params, $additionalParams);
        }

        //$this->client->request

        return $this->client->get('', ['query' => $params])->xml();
    }

    private function parseXMLObject($object)
    {
        return json_decode(json_encode($object));
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

}