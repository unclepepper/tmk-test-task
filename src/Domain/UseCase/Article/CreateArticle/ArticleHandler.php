<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Article\CreateArticle;

use App\Domain\Entity\Article\Article;
use App\Domain\Repository\Article\ArticleRepositoryInterface;
use App\Domain\Service\Article\ArticleCommandService;
use InvalidArgumentException;

readonly class ArticleHandler
{

    public function __construct(
        private ArticleRepositoryInterface $articleRepository,
        private ArticleCommandService $commandService,
    ) {}

    public function handle(ArticleDto $command): Article
    {
        try
        {
            $article = $this->commandService->create($command);
        }
        catch(\Exception $exception)
        {
            throw new InvalidArgumentException($exception->getMessage());
        }

        $this->articleRepository->save($article);

        return $article;
    }
}
