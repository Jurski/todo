<?php

namespace App;

use Exception;

class EntryManager
{
    private array $entries = [];

    public function __construct()
    {
        $this->loadData();
    }

    public function saveData(): void
    {
        file_put_contents("data.json", json_encode($this->entries, JSON_PRETTY_PRINT));
    }

    public function createEntry(string $content): void
    {
        $id = strval(count($this->entries) + 1);
        $newEntry = new Entry($id, $content);
        $this->entries[$id] = $newEntry;
        $this->saveData();
    }

    public function deleteEntry(string $id): bool
    {
        if (isset($this->entries[$id])) {
            unset($this->entries[$id]);
            $this->saveData();
            return true;
        }
        return false;
    }

    public function getEntries(): array
    {
        $this->loadData();
        return $this->entries;
    }

    public function markEntryCompleted(string $id): bool
    {
        if (isset($this->entries[$id])) {
            $this->entries[$id]->markCompleted();
            echo($this->entries[$id]->getStatus());
            $this->saveData();
            echo($this->entries[$id]->getStatus());
            return true;
        }
        return false;
    }

    private function loadData(): void
    {
        try {
            if (file_exists("data.json")) {
                $taskData = json_decode(file_get_contents("data.json"), true);
                foreach ($taskData as $entry) {
                    $this->entries[$entry['id']] = new Entry($entry['id'], $entry['content'], $entry['status']);
                }
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . PHP_EOL;
        }
    }
}