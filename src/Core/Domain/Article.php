<?php

namespace App\Core\Domain;

readonly class Article
{
    public function __construct(
        private int $id,
        private string $name,
        private string $summary,
        private string $author,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }
}
