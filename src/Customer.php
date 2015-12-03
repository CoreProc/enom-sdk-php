<?php

namespace Coreproc\Enom;

class Customer
{

    private $client;

    public function __construct(Enom $enom)
    {
        $this->client = $enom->getClient();
    }

    public function updatePreferences(array $params)
    {
        $response = $this->parseXMLObject($this->doGetRequest('UpdateCusPreferences', $params));

        if ($response->ErrCount > 0) {
            throw new EnomApiException($response->errors);
        }

        return $response;
    }

    public function getPreferences()
    {
        $response = $this->parseXMLObject($this->doGetRequest('GetCusPreferences', $params));

        if ($response->ErrCount > 0) {
            throw new EnomApiException($response->errors);
        }

        return $response;
    }


    private function doGetRequest($command, $additionalParams = [])
    {
        $params = [
            'command' => $command,
        ];

        if (count($additionalParams)) {
            $params = array_merge($params, $additionalParams);
        }

        return $this->client->get('', ['query' => $params])->xml();
    }

    private function parseXMLObject($object)
    {
        return json_decode(json_encode($object));
    }
}