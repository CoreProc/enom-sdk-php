<?php

namespace Coreproc\Enom;

use Exception;

class EnomTld
{

    /**
     * @var Enom
     */
    private $enom;

    public function __construct(Enom $enom)
    {
        $this->enom = $enom;
    }

    public function authorize(array $tlds)
    {
        try {
            return $this->enom->call('AuthorizeTLD', [
                'domainlist' => implode(',', $tlds),
            ])->tldList;
        } catch (Exception $e) {
            throw $e;
        }

    }

    public function remove(array $tlds)
    {
        try {
            return $this->enom->call('RemoveTLD', [
                'domainlist' => implode(',', $tlds),
            ])->tldlist;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getList()
    {
        try {
            return $this->enom->call('GetTLDList')->tldlist;
        } catch (Exception $e) {
            throw $e;
        }
    }

}