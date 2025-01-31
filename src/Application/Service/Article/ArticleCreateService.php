<?php

declare(strict_types=1);

namespace App\Application\Service\Article;

use App\Domain\Repository\Article\ArticleRepositoryInterface;
use App\Domain\UseCase\Article\CreateArticle\ArticleDto;
use App\Domain\UseCase\Article\CreateArticle\ArticleHandler;
use Exception;


readonly class ArticleCreateService implements ArticleCreateServiceInterface
{

    public function __construct(
        private ArticleHandler $articleHandler,
        private ArticleRepositoryInterface $articleRepository
    ) {}

    /**
     * @throws Exception
     */
    public function create(string $filename): bool
    {
        $articles = $this->parse($filename);

        if($this->createDto($articles))
        {
            return true;
        }

        return false;
    }

    /**
     * @param array $articles
     * @return false
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

    /**
     * @throws Exception
     */
    private function parse(string $filename): array
    {
        if(!file_exists($filename))
        {
            throw new Exception('Cannot open file');
        }

        if(($handle = fopen($filename, 'r')) !== false)
        {


            $data = [];


            if(($header = fgetcsv($handle, 1000, ';')) !== false)
            {

                while(($row = fgetcsv($handle, 1000, ';')) !== false)
                {

                    if(count($header) !== count($row))
                    {
                        continue;
                    }

                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        else
        {
            throw new Exception('File not found');
        }

        return $data;
    }

    private function checkArticle(string $title): bool
    {
        return $this->articleRepository->titleExist($title);
    }
}
