<?php

namespace Coreproc\Enom;

use GuzzleHttp\Client;

class Tld
{

    /**
     * @var Enom
     */
    private $enom;

    private $client;

    public function __construct(Enom $enom)
    {
        $this->enom = $enom;
        $this->client = new Client([
            'base_url' => 'https://resellertest.enom.com/interface.asp'
        ]);
    }

    public function authorize(array $tlds)
    {
        $response = $this->doGetRequest('AuthorizeTLD', [
            'domainlist' => implode(',', $tlds),
        ]);

        $response = $this->parseXMLObject($response);

        return $response->tldlist->authorizetld;
    }

    public function remove(array $tlds)
    {
        $response = $this->doGetRequest('RemoveTLD', [
            'domainlist' => implode(',', $tlds),
        ]);

        $response = $this->parseXMLObject($response);

        return $response->tldlist->deletetld;
    }

    public function getList()
    {
        $response = $this->doGetRequest('GetTLDList');

        $response = $this->parseXMLObject($response);

        return $response->tldlist->tld;
    }

    private function doGetRequest($command, $additionalParams = [])
    {
        $params = [
            'command'      => $command,
            'uid'          => $this->enom->userId,
            'pw'           => $this->enom->password,
            'responsetype' => 'xml'
        ];

        if (count($params)) {
            $params = array_merge($params, $additionalParams);
        }

        return $this->client->get('', ['query' => $params])->xml();
    }

    private function parseXMLObject($object)
    {
        return json_decode(json_encode($object));
    }
}