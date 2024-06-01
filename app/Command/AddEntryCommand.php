<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\EntryManager;

class AddEntryCommand extends Command
{
    protected static $defaultName = 'entry:add';

    protected function configure()
    {
        $this
            ->setDescription('Adds a new task')
            ->addArgument('description', InputArgument::REQUIRED, 'Enter the task description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $description = $input->getArgument('description');
        $entryManager = new EntryManager();
        $entryManager->createEntry($description);
        $output->writeln('Task added: ' . $description);
        return Command::SUCCESS;
    }
}