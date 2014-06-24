<?php

namespace Ck\Hackex\Service;

class HackexService extends WebService
{
    private $token = null;

    public function __construct()
    {
        parent::__construct('json');
    }

    public static function getBaseUrl()
    {
        return 'https://api.hackex.net/v3/';
    }

    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    protected function getHeaders()
    {
        if  ($this->token === null)
            return array(
                'BYPASS-SERVER-MAINTENANCE' => '',
            );

        return array(
            'X-API-KEY' => $this->token,
        );
    }
}
