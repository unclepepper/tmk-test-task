<?php

declare(strict_types=1);

namespace App\Domain\Service\Article;


use App\Domain\Entity\Article\Article;
use App\Domain\UseCase\Article\CreateArticle\ArticleDto;

interface ArticleCommandServiceInterface
{
    public function create(ArticleDto $command): Article;
}
