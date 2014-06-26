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
        $ru         = new RandomUserService();
        $user       = $ru->get()->results[0]->user;
        $h          = new HackexService();
        
        $username   = 'goldenpanda856';
        $email      = 'christian.dean38@guerrillamail.com';
        $passwd     = 'jaime';
        $auth       = $h->auth($email, $passwd)->user;

        $output->writeln('user: '.$username);
        $output->writeln('email: '.$email);
        $output->writeln('password: '.$passwd);

        $h->setToken($auth->auth_token);
        var_dump($h->getProcesses());
        var_dump($h->getSoftware());
        var_dump($h->getViruses());
    }
}
