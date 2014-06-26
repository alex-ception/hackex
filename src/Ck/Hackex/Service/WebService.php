<?php

namespace Ck\Hackex\Service;

use Symfony\Component\Console\Output\OutputInterface;
use Buzz\Browser;
use Buzz\Message\RequestInterface;

abstract class WebService
{
    private $debug_level;
    private $browser;
    private $result_transformer;

    public function __construct($result_transformer = null, $debug_level = 1)
    {
        $this->debug_level          = $debug_level;
        $this->browser              = new Browser();
        $this->result_transformer   = $result_transformer;
    }

    abstract public static function getBaseUrl();

    public function setDebugLevel($debug_level)
    {
        $this->debug_level = (int) $debug_level;
    }
    
    public function debug($content)
    {
        if ($this->debug_level === 0)
            return;

        echo '[DEBUG] '.$content."\n";
    }
    
    public function buildUrl($path = null, array $query = array())
    {
        $url = static::getBaseUrl();

        if ($path !== null)
        {
            if ($url[strlen($url) - 1] !== '/')
                $url .= '/';

            $url = sprintf('%s%s', $url, $path);
        }

        if (empty($query))
            return $url;

        return sprintf('%s?%s', $url, http_build_query($query));
    }

    protected function getBrowser()
    {
        return $this->browser;
    }

    protected function getHeaders()
    {
        return array(
        );
    }

    protected function get($path = null, array $query = array())
    {
        $url = $this->buildUrl($path, $query);
        
        $this->debug('GET '.$url);

        $this->browser->get($url, $this->getHeaders());

        return $this->getResult();
    }

    protected function post($path = null, array $fields, array $query = array())
    {
        $url = $this->buildUrl($path, $query);

        $this->debug('POST '.$url);
        foreach ($fields as $key => $value)
            $this->debug ('FIELD '.$key.' : '.$value);

        $this->browser->submit($url, $fields, RequestInterface::METHOD_POST, $this->getHeaders());

        return $this->getResult();
    }

    protected function getResult()
    {
        $response = $this->browser->getLastResponse()->getContent();

        switch ($this->result_transformer) {
            case 'json':
                return json_decode($response);
            case 'html':
            case 'raw':
            case null:
            default:
                return $response;
            case (class_exists($this->result_transformer) === true):
                return new ${$this->result_transformer}($response);
        }
    }
}
