<?php

namespace App;

use JsonSerializable;

class Entry implements JsonSerializable
{
    private string $id;
    private string $content;
    private string $status;

    public function __construct(string $id, string $content, string $status = 'ongoing')
    {
        $this->id = $id;
        $this->content = $content;
        $this->status = $status;
    }

    public function markCompleted(): void
    {
        $this->status = 'completed';
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'status' => $this->status,
        ];
    }
}