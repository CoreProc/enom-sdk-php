<?php

namespace Coreproc\Enom\Accessors;

use Coreproc\Enom\EnomAccessor;
use Exception;

class Tld extends EnomAccessor
{

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
            return $this->enom->call('GetTLDList')->tldlist->tld;
        } catch (Exception $e) {
            throw $e;
        }
    }

}