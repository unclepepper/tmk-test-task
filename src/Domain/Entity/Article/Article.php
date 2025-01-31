<?php

declare(strict_types=1);

namespace App\Domain\Entity\Article;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity]
#[ORM\Table(name: 'article')]
#[ORM\Index(columns: ['active'])]
class Article
{
    #[ORM\Id, ORM\Column(type: 'integer', options: ['unsigned' => true]), ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: true)]
    private string $title;

    #[Gedmo\Slug(fields: ['title', 'id'])]
    #[ORM\Column(type: 'string', length: 128, unique: true, nullable: false)]
    private string $slug;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $active = false;

    #[ORM\Column(type: 'integer', options: ['default' => 0, 'comment' => 'Количество просмотров'])]
    private string $numberOfViews;

    #[ORM\Column(type: Types::TEXT, nullable: true, options: ['default' => ''])]
    private ?string $description;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    public function __toString(): string
    {
        return $this->title;
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

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;
        return $this;
    }

    public function getNumberOfViews(): string
    {
        return $this->numberOfViews;
    }

    public function setNumberOfViews(string $numberOfViews): self
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

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

}
