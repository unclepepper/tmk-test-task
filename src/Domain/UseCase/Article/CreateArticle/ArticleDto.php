<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Article\CreateArticle;

use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

class ArticleDto
{
    #[Assert\NotBlank]
    private string $title;

    #[Assert\Type('boolean')]
    private bool $active = false;

    #[Assert\Type('integer')]
    private ?int $numberOfViews;

    private ?string $description;

    #[Assert\Type('datetime_immutable')]
    private DateTimeImmutable $createdAt;

    public function __construct(
        string $title,
        ?int $numberOfViews,
        ?string $description
    ) {
        $this->title = $title;
        $this->numberOfViews = $numberOfViews;
        $this->description = $description;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function active(): self
    {
        $this->active = true;
        return $this;
    }

    public function getNumberOfViews(): ?int
    {
        return $this->numberOfViews;
    }

    public function setNumberOfViews(?int $numberOfViews): self
    {
        $this->numberOfViews = $numberOfViews;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

}
