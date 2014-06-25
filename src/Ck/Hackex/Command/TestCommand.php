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
        $ru = new RandomUserService();
        $h  = new HackexService();

        $user   = $ru->get()->results[0]->user;
        $email  = substr($user->email, 0, strpos($user->email, '@'));
        $nick   = $user->username;
        $passwd = $user->password;

        $output->writeln(sprintf('User: %s', $nick));
        $output->writeln(sprintf('email: %s', $email));
        $output->writeln(sprintf('Password: %s', $passwd));

        var_dump($h->register($email, $nick, $passwd, 1));
    }
}
