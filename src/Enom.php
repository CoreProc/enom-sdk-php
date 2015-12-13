<?php

namespace Coreproc\Enom;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TooManyRedirectsException;
use SimpleXMLElement;

class Enom
{

    /**
     * @var Client
     */
    protected $client = null;

    protected $userId;

    protected $password;

    protected $baseUrl;

    public function __construct($userId, $password, $test = false)
    {
        $this->userId = $userId;
        $this->password = $password;

        // This is the LIVE API URL
        $this->baseUrl = 'https://reseller.enom.com/interface.asp';

        // We set to the development URL if testing is true
        if ($test === true) {
            $this->baseUrl = 'https://resellertest.enom.com/interface.asp';
        }

        // Since we can't include the default queries in the Guzzle client, we set this here
        $this->defaultParams = [
            'uid'          => $this->userId,
            'pw'           => $this->password,
            'responsetype' => 'xml'
        ];
    }

    /**
     * Grab the default Guzzle client for this API
     *
     * @return Client
     */
    public function getClient()
    {
        return new Client([
            'base_uri' => $this->baseUrl,
        ]);
    }

    /**
     * Basic function to call Enom API
     *
     * @param $command
     * @param array $additionalParams
     * @return mixed
     * @throws EnomApiException
     */
    public function call($command, $additionalParams = [])
    {
        if (is_null($this->client)) {
            $this->client = $this->getClient();
        }

        $params = [
            'command' => $command,
        ];

        $params = array_merge($params, $additionalParams, $this->defaultParams);

        try {
            $response = $this->client->get('', ['query' => $params]);

            $xmlObject = $this->parseXMLObject($response->getBody()->getContents());

            // Because enom throws 200 even during an error, we count the errors written
            // in their response and throw an exception.
            if ($xmlObject->ErrCount > 0) {
                $message = $xmlObject->errors->Err1;
                $code = $xmlObject->responses->response->ResponseNumber;
                throw new EnomApiException($message, $code);
            }

            // Everything checks out
            return $xmlObject;

        } catch (ConnectException $e) {
            throw $e;
        } catch (ClientException $e) {
            throw $e;
        } catch (ServerException $e) {
            throw $e;
        } catch (TooManyRedirectsException $e) {
            throw $e;
        } catch (RequestException $e) {
            throw $e;
        }

    }

    /**
     * Parse the XML response
     *
     * @param $xmlBody
     * @return mixed
     */
    private function parseXMLObject($xmlBody)
    {
        $data = new SimpleXMLElement($xmlBody);
        return json_decode(json_encode($data, JSON_NUMERIC_CHECK));
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