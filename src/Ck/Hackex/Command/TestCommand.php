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

        var_dump($ru->get());
    }
}
