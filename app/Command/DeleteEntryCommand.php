<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\EntryManager;

class DeleteEntryCommand extends Command
{
    protected static $defaultName = 'entry:delete';

    protected function configure()
    {
        $this
            ->setDescription('Deletes a task')
            ->addArgument('id', InputArgument::REQUIRED, 'Enter Task ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = $input->getArgument('id');
        $entryManager = new EntryManager();
        if ($entryManager->deleteEntry($id)) {
            $output->writeln('Task deleted: ' . $id);
        } else {
            $output->writeln('Task not found: ' . $id);
        }
        return Command::SUCCESS;
    }
}