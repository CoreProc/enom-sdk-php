<?php

namespace Coreproc\Enom;

class MagicFolder
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

	/**
	* Assign one or more domains to one folder.
	* @var $domainNameList mixed - Array or string
	*/
    public function assignToDomainFolder($domainNameList, $toFolderName, 
    	$transferMode=1, $fromFolderName)
    {
        $response = $this->doGetRequest('AssignToDomainFolder', [
            'domainnamelist' => is_array($domainNameList) ? implode(',', $domainNameList) : $domainNameList,
            'transfermode' => $transferMode,
            'fromfoldername' => $fromFolderName,
            'tofoldername' => $toFolderName
        ]);

        $response = $this->parseXMLObject($response);

        if ($response->ErrCount > 0) {
            throw new EnomApiException($response->errors);
        }

        return $response->tldlist;
    }
}