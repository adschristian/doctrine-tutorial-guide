<?php

declare(strict_types=1);

namespace App;

class Product
{
    private ?int $id;

    public function __construct(
        private string $name
    ) {
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function setName(string $newName): self
    {
        $this->name = $newName;

        return $this;
    }
}
