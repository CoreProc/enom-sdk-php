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

        $response = $this->parseXMLObject($response);

        if ($response->ErrCount > 0) {
            throw new EnomApiException($response->errors);
        }

        return $response;
    }

    public function getNameSpinner($sld, $tld, array $options = [])
    {
        $response = $this->doGetRequest('NameSpinner', [
            'sld'        => $sld,
            'tld'        => $tld,
            'UseHyphens' => (isset($options['useHyphens'])) ? $options['useHyphens'] : true,
            'UseNumbers' => (isset($options['useNumbers'])) ? $options['useNumbers'] : true,
            'MaxResults' => (isset($options['maxResults'])) ? $options['maxResults'] : 10,
        ]);

        $response = $this->parseXMLObject($response);

        if ($response->ErrCount > 0) {
            throw new EnomApiException($response->errors);
        }

        return $response->namespin;
    }

    public function getExtendedAttributes($tld)
    {
        $response = $this->doGetRequest('GetExtAttributes', [
            'tld' => $tld,
        ]);

        $response = $this->parseXMLObject($response);

        if ( ! isset($response->Attributes)) {
            throw new \Exception('Invalid TLD');
        }

        return $response->Attributes;
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

        $response = $this->parseXMLObject($response);

        if ($response->ErrCount > 0) {
            throw new EnomApiException($response->errors);
        }

        return $response;
    }

    public function getStatus($sld, $tld, $orderId)
    {
        $response = $this->doGetRequest('GetDomainStatus', [
            'sld'       => $sld,
            'tld'       => $tld,
            'orderid'   => $orderId,
            'ordertype' => 'purchase',
        ]);

        $response = $this->parseXMLObject($response);

        if ($response->ErrCount > 0) {
            throw new EnomApiException($response->errors);
        }

        return $response;
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

        $response = $this->parseXMLObject($response);

        if ($response->ErrCount > 0) {
            throw new EnomApiException($response->errors);
        }

        return $response;
    }

    public function setContactInformation($sld, $tld, array $contactInfo = [])
    {
        $params = [
            'sld' => $sld,
            'tld' => $tld,
        ];

        $params = array_merge($params, $contactInfo);

        $response = $this->doGetRequest('Contacts', $params);

        $response = $this->parseXMLObject($response);

        if ($response->ErrCount > 0) {
            throw new EnomApiException($response->errors);
        }

        return $response;
    }

    public function getContactInformation($sld, $tld)
    {
        $response = $this->doGetRequest('GetContacts', [
            'sld' => $sld,
            'tld' => $tld,
        ]);

        $response = $this->parseXMLObject($response);

        if ($response->ErrCount > 0) {
            throw new EnomApiException($response->errors);
        }

        return $response;
    }

    public function getWhoIsContactInformation($sld, $tld)
    {
        $response = $this->doGetRequest('GetWhoIsContact', [
            'sld' => $sld,
            'tld' => $tld,
        ]);

        $response = $this->parseXMLObject($response);

        if ($response->ErrCount > 0) {
            throw new EnomApiException($response->errors);
        }

        return $response;
    }
}
