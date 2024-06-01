<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\EntryManager;

class MarkEntryCompletedCommand extends Command
{
    protected static $defaultName = 'entry:complete';

    protected function configure()
    {
        $this
            ->setDescription('Marks a task as completed')
            ->addArgument('id', InputArgument::REQUIRED, 'Enter Task ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = $input->getArgument('id');
        $entryManager = new EntryManager();
        if ($entryManager->markEntryCompleted($id)) {
            $output->writeln('Task marked as completed: ' . $id);
        } else {
            $output->writeln('Task not found: ' . $id);
        }
        return Command::SUCCESS;
    }
}