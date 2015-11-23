<?php

namespace Coreproc\Enom;

class Domain
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

    public function check($sld, $tld)
    {
        $response = $this->doGetRequest('check', [
            'sld' => $sld,
            'tld' => $tld,
        ]);

        return $this->parseXMLObject($response);
    }

    public function getNameSpinner($sld, $tld, array $options = [])
    {
        $response = $this->doGetRequest('NameSpinner', [
            'sld'        => $sld,
            'tld'        => $tld,
            'UseHyphens' => $options['useHyphens'] ?: true,
            'UseNumbers' => $options['useNumbers'] ?: true,
            'MaxResults' => $options['maxResults'] ?: 10,
        ]);

        return $this->parseXMLObject($response->namespin);
    }

    public function getExtendedAttributes($tld)
    {
        $response = $this->doGetRequest('GetExtAttributes', [
            'tld'        => $tld,
        ]);

        return $this->parseXMLObject($response->Attributes);
    }

    public function purchase($sld, $tld, array $extendedAttributes = [])
    {
        $params = [
            'sld' => $sld,
            'tld' => $tld,
        ];

        if (count($extendedAttributes)) {
            $params = array_merge($params, $extendedAttributes);
        }

        $response = $this->doGetRequest('Purchase', $params);

        return $this->parseXMLObject($response);
    }

    public function getStatus($sld, $tld, $orderId)
    {
        $response = $this->doGetRequest('GetDomainStatus', [
            'sld'       => $sld,
            'tld'       => $tld,
            'orderid'   => $orderId,
            'ordertype' => 'purchase',
        ]);

        return $this->parseXMLObject($response);
    }

    public function getList()
    {
        $response = $this->doGetRequest('GetDomains');

        return $response;
    }

    public function getExpired()
    {
        $response = $this->doGetRequest('GetExpiredDomains');

        return $response;
    }

    public function getInfo($sld, $tld)
    {
        $response = $this->doGetRequest('GetDomainInfo', [
            'sld' => $sld,
            'tld' => $tld
        ]);

        return $this->parseXMLObject($response);
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
