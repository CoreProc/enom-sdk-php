<?php

namespace Coreproc\Enom\Accessors;

use Coreproc\Enom\EnomAccessor;
use Exception;

class Domain extends EnomAccessor
{

    public function check($sld, $tld)
    {
        try {
            return $this->enom->call('check', [
                'sld' => $sld,
                'tld' => $tld,
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getNameSpinner($sld, $tld, array $options = [])
    {
        try {
            return $this->enom->call('NameSpinner', [
                'sld'        => $sld,
                'tld'        => $tld,
                'UseHyphens' => (isset($options['useHyphens'])) ? $options['useHyphens'] : true,
                'UseNumbers' => (isset($options['useNumbers'])) ? $options['useNumbers'] : true,
                'MaxResults' => (isset($options['maxResults'])) ? $options['maxResults'] : 10,
            ])->namespin;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getDomainPricing()
    {
        try {
            return $this->enom->call('PE_GETDOMAINPRICING');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getExtendedAttributes($tld)
    {
        try {
            return $this->enom->call('GetExtAttributes', [
                'tld' => $tld,
            ]);
        } catch (Exception $e) {
            throw $e;
        }
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

        try {
            return $this->enom->call('Purchase', $params);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getStatus($sld, $tld, $orderId)
    {
        try {
            return $this->enom->call('GetDomainStatus', [
                'sld'       => $sld,
                'tld'       => $tld,
                'orderid'   => $orderId,
                'ordertype' => 'purchase',
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getList()
    {
        try {
            return $this->enom->call('GetDomains');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getExpired()
    {
        try {
            return $this->enom->call('GetExpiredDomains');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getInfo($sld, $tld)
    {
        try {
            return $this->enom->call('GetDomainInfo', [
                'sld' => $sld,
                'tld' => $tld
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function setContactInformation($sld, $tld, array $contactInfo = [])
    {
        $params = [
            'sld' => $sld,
            'tld' => $tld,
        ];

        $params = array_merge($params, $contactInfo);

        try {
            return $this->enom->call('Contacts', $params);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getContactInformation($sld, $tld)
    {
        try {
            return $this->enom->call('GetContacts', [
                'sld' => $sld,
                'tld' => $tld,
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getWhoIsContactInformation($sld, $tld)
    {
        try {
            return $this->enom->call('GetWhoIsContact', [
                'sld' => $sld,
                'tld' => $tld,
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function checkNSStatus($nameServer)
    {
        try {
            return $this->enom->call('CheckNSStatus', [
                'CheckNSName' => $nameServer
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteNameServer($nameServer)
    {
        try {
            return $this->enom->call('DeleteNameServer', [
                'ns' => $nameServer
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getDNS($sld, $tld)
    {
        try {
            return $this->enom->call('GetDNS', [
                'sld' => $sld,
                'tld' => $tld,
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getDNSStatus($sld, $tld)
    {
        try {
            return $this->enom->call('GetDNSStatus', [
                'sld' => $sld,
                'tld' => $tld,
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function modifyNS($sld, $tld, array $nameServers = [])
    {
        try {
            $params = [
                'sld' => $sld,
                'tld' => $tld,
            ];

            array_merge($params, $nameServers);

            return $this->enom->call('modifyNS', $params);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function modifyNSHosting($sld, $tld, array $nameServers = [])
    {
        try {
            $params = [
                'sld' => $sld,
                'tld' => $tld,
            ];

            array_merge($params, $nameServers);

            return $this->enom->call('modifyNSHosting', $params);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function registerNameServer($nameServer, $ipAddress)
    {
        try {
            return $this->enom->call('RegisterNameServer', [
                'Add'=> 'true',
                'NSName' => $nameServer,
                'IP' => $ipAddress
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateNameServer($nameServer, $oldIpAddress, $newIpAddress)
    {
        try {
            return $this->enom->call('UpdateNameServer', [
                'NS' => $nameServer,
                'OldIP' => $oldIpAddress,
                'NewIP' => $newIpAddress
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
