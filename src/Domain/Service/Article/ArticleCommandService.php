<?php

declare(strict_types=1);

namespace App\Domain\Service\Article;

use App\Domain\Entity\Article\Article;
use App\Domain\UseCase\Article\CreateArticle\ArticleDto;

class ArticleCommandService implements ArticleCommandServiceInterface
{
    public function create(ArticleDto $command): Article
    {
        return (new Article())
            ->setTitle($command->getTitle())
            ->setActive($command->getActive())
            ->setNumberOfViews($command->getNumberOfViews())
            ->setDescription($command->getDescription())
            ->setCreatedAt($command->getCreatedAt());
    }
}
