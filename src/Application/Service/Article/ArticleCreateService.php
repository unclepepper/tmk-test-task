<?php

declare(strict_types=1);

namespace App\Application\Service\Article;

use App\Application\Service\Common\Parse\ParseFileInterface;
use App\Application\Service\Common\Parse\ParseTxtFile;
use App\Domain\Repository\Article\ArticleRepositoryInterface;
use App\Domain\UseCase\Article\CreateArticle\ArticleDto;
use App\Domain\UseCase\Article\CreateArticle\ArticleHandler;
use Exception;


readonly class ArticleCreateService implements ArticleCreateServiceInterface
{

    public function __construct(
        private ArticleHandler $articleHandler,
        private ArticleRepositoryInterface $articleRepository,
        private ParseFileInterface $parseTxtFile
    ) {}

    /**
     * @throws Exception
     */
    public function createFromFile(string $path): bool
    {

        if($this->createDto($this->parseTxtFile->parse($path)))
        {
            return true;
        }

        return false;
    }

    /**
     * @param array<string, mixed> $articles
     * @return bool
     * @throws Exception
     */
    public function createDto(array $articles): bool
    {
        if(empty($articles))
        {
            return false;
        }

        foreach($articles as $article)
        {
            if($this->checkArticle($article['title']))
            {
                continue;
            }

            $articleDto = new ArticleDto(
                $article['title'],
                (int) $article['numberOfViews'],
                $article['description'],
            );

            if($article['active'])
            {
                $articleDto->active();
            }


            $this->articleHandler->handle($articleDto);
        }
        return true;
    }

    private function checkArticle(string $title): bool
    {
        return $this->articleRepository->titleExist($title);
    }
}
