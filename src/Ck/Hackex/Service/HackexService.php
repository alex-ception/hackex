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
    
    public function getUser($extras = true)
    {
        return $this->get('user', array('extras' => $extras));
    }

    public function getContacts()
    {
        return $this->get('contacts');
    }

    public function getPendingContacts()
    {
        return $this->get('contacts_pending');
    }

    public function getStore()
    {
        return $this->get('store');
    }

    public function getSpam()
    {
        return $this->get('user_spam');
    }

    public function getSpyware()
    {
        return $this->get('user_spyware');
    }

    public function getBank()
    {
        return $this->get('user_bank');
    }

    public function getNotepad()
    {
        return $this->get('user_notepad');
    }
    
    public function getProcesses()
    {
        return $this->get('user_processes');
    }
    
    public function getSoftware()
    {
        return $this->get('user_software');
    }
    
    public function getViruses()
    {
        return $this->get('user_viruses');
    }
    
    public function getRandomUsers($total = 10)
    {
        return $this->get('users_random', array('count' => $total));
    }
}
