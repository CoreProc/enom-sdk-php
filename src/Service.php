<?php
namespace Coreproc\Enom;

class Service
{
	 protected function doGetRequest($command, $additionalParams = [])
    {
        $params = [
            'command' => $command,
        ];

        if (count($additionalParams)) {
            $params = array_merge($params, $additionalParams);
        }

        return $this->client->get('', ['query' => $params])->xml();
    }

    protected function parseXMLObject($object)
    {
        return json_decode(json_encode($object));
    }
}