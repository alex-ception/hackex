<?php

namespace Ck\Hackex\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Ck\Hackex\Service\RandomUserService;
use Ck\Hackex\Service\HackexService;

class TestCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('test')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $h      = new HackexService();
        $user   = 'heavyostrich492';
        $passwd = 'moses';
        $email  = 'pauline.bryant69';
        $token  = '813CFBEC-DEA8-2239-DEF2-D55E344C5505';

        $h->setToken($token);
        var_dump($h->auth($email, $passwd));
    }
}
