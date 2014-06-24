<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;

use Ck\Hackex\Command\TestCommand;

$app = new Application();
$app->add(new TestCommand);
$app->run();
