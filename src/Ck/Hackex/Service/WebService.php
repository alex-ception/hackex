<?php

namespace Ck\Hackex\Service;

use Buzz\Browser;

class WebService
{
    const URL = 'https://api.hackex.net/v3/';

    private $browser;
    private $token;

    public function __construct()
    {
        $this->browser  = new Browser();
        $this->token    = null;
    }

    public static function buildUrl($path, array $query = $query())
    {
        $url = sprintf('%s%s', self::URL, $path);

        if (empty($query))
            return $url;

        return sprintf('%s?%s', $url, http_build_query($query));
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

    protected function getBrowser()
    {
        return $this->browser;
    }

    protected function get($path, array $query = array())
    {
        $url = self::buildUrl($path, $query);

        $this->browser->get($url, $this->getHeaders());
    }

    protected function post($path, array $query = array())
    {
        $url = self::buildUrl($path, $query);

        $this->browser->post($url, $this->getHeaders());
    }
}
