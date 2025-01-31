<?php

declare(strict_types=1);

namespace App\Presentation\Http\App\Controller\Article;

use App\Domain\Repository\Article\ArticleRepositoryInterface;
use App\Domain\RepositoryFilter\Article\ArticleFilter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/article/index/{active}', name: 'article.index', methods: ['GET'])]
class IndexController extends AbstractController
{

    public function __invoke(
        bool $active,
        ArticleRepositoryInterface $articleRepository
    ): Response
    {
        $filter = new ArticleFilter();
        $filter->active = $active;

        return $this->render('app/article/index/index.html.twig', [
            "articles" => $articleRepository->findArticles($filter),
            "active" => $active,
        ]);
    }
}
