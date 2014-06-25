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
        return 'http://api.hackex.net/v3/';
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

    public function isOn()
    {
        return $this->get('check_server_maintenance');
    }

    public function register($email, $username, $password, $os_type_id)
    {
        $fields = array(
            'email'         => $email,
            'username'      => $username,
            'password'      => $password,
            'os_type_id'    => $os_type_id,
        );

        return $this->post('user', $fields);
    }

    public function auth($email, $password)
    {
        $fields = array(
            'email'     => $email,
            'password'  => $password,
        );

        return $this->post('auth', $fields);
    }
}
