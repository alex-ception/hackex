<?php

namespace Ck\Hackex\Service;

class RandomUserService extends WebService
{
    public function __construct()
    {
        parent::__construct('json');
    }

    public static function getBaseUrl()
    {
        return 'http://api.randomuser.me/';
    }

    public function get()
    {
        return parent::get();
    }
}
