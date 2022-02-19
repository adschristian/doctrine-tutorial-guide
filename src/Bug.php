<?php

declare(strict_types=1);

namespace App;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class Bug
{
    private ?int $id;
    private Collection $products;
    private User $engineer;
    private User $reporter;

    public function __construct(
        private string $status,
        private ?string $description = null,
        private ?DateTimeInterface $createdAt = new DateTimeImmutable(),
    ) {
        $this->createdAt = $createdAt;
        $this->products = new ArrayCollection();
    }

    public function description(): string
    {
        return $this->description;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function setEngineer(User $engineer): self
    {
        $engineer->assignedToBug($this);
        $this->engineer = $engineer;

        return $this;
    }

    public function setReporter(User $reporter): self
    {
        $reporter->addReportedBug($this);
        $this->reporter = $reporter;

        return $this;
    }

    public function engineer(): User
    {
        return $this->engineer;
    }

    public function reporter(): User
    {
        return $this->reporter;
    }

    public function assignToProduct(Product $product): void
    {
        $this->products->add($product);
    }

    /**
     * @return Product[]
     */
    public function products(): Collection
    {
        return $this->products;
    }
}
