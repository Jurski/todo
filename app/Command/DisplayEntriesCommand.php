<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use App\EntryManager;

class DisplayEntriesCommand extends Command
{
    protected static $defaultName = 'entry:display';

    protected function configure()
    {
        $this
            ->setDescription('Displays all tasks');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $entryManager = new EntryManager();
        $entries = $entryManager->getEntries();

        if (empty($entries)) {
            echo "Cant output an empty list";
            return Command::FAILURE;
        }

        $table = new Table($output);
        $table->setHeaders(['ID', 'Description', 'Status']);

        foreach ($entries as $entry) {
            $table->addRow([$entry->getId(), $entry->getContent(), $entry->getStatus()]);
        }

        $table->render();
        return Command::SUCCESS;
    }
}