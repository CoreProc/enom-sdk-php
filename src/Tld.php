<?php

namespace Coreproc\Enom;

class Tld extends Service
{

    /**
     * @var Enom
     */
    private $enom;

    private $client;

    public function __construct(Enom $enom)
    {
        $this->enom = $enom;
        $this->client = $enom->getClient();
    }

    public function authorize(array $tlds)
    {
        $response = $this->doGetRequest('AuthorizeTLD', [
            'domainlist' => implode(',', $tlds),
        ]);

        $response = $this->parseXMLObject($response);

        if ($response->ErrCount > 0) {
            throw new EnomApiException($response->errors);
        }

        return $response->tldlist;
    }

    public function remove(array $tlds)
    {
        $response = $this->doGetRequest('RemoveTLD', [
            'domainlist' => implode(',', $tlds),
        ]);

        $response = $this->parseXMLObject($response);

        if ($response->ErrCount > 0) {
            throw new EnomApiException($response->errors);
        }

        return $response->tldlist;
    }

    public function getList()
    {
        $response = $this->doGetRequest('GetTLDList');

        $response = $this->parseXMLObject($response);

        return $response->tldlist;
    }
}