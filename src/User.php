<?php

declare(strict_types=1);

namespace App;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class User
{
    private ?int $id;
    private Collection $reportedBugs;
    private Collection $assignedBugs;

    public function __construct(private string $name)
    {
        $this->reportedBugs = new ArrayCollection();
        $this->assignedBugs = new ArrayCollection();
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function addReportedBug(Bug $bug): void
    {
        $this->reportedBugs->add($bug);
    }

    public function assignedToBug(Bug $bug): void
    {
        $this->assignedBugs->add($bug);
    }
}
