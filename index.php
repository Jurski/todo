<?php

require __DIR__ . '/vendor/autoload.php';

use App\Command\AddEntryCommand;
use App\Command\DeleteEntryCommand;
use App\Command\MarkEntryCompletedCommand;
use App\Command\DisplayEntriesCommand;
use App\Command\SaveEntriesCommand;

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new AddEntryCommand());
$application->add(new DeleteEntryCommand());
$application->add(new MarkEntryCompletedCommand());
$application->add(new DisplayEntriesCommand());
$application->add(new SaveEntriesCommand());

$application->run();