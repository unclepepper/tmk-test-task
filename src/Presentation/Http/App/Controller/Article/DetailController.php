<?php

declare(strict_types=1);

namespace App\Presentation\Http\App\Controller\Article;

use App\Domain\Repository\Article\ArticleRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/article/detail/{slug}', name: 'article.detail', methods: ['GET', 'POST'])]
class DetailController extends AbstractController
{

    public function __invoke(
        string $slug,
        ArticleRepositoryInterface $articleRepository
    ): Response
    {
        $article = $articleRepository->findBySlug($slug);

        return $this->render('app/article/detail/index.html.twig', [
            'article' => $article,
        ]);
    }
}
