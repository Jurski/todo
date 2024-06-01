<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\EntryManager;

class SaveEntriesCommand extends Command
{
    protected static $defaultName = 'entry:save';

    protected function configure()
    {
        $this
            ->setDescription('Saves all tasks');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $entryManager = new EntryManager();
        $entryManager->saveData();
        $output->writeln('Tasks saved successfully!');
        return Command::SUCCESS;
    }
}