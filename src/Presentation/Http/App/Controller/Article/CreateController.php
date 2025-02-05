<?php

declare(strict_types=1);

namespace App\Presentation\Http\App\Controller\Article;

use App\Application\Service\Article\ArticleCreateServiceInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/article/new', name: 'article.new', methods: ['GET', 'POST'])]
class CreateController extends AbstractController
{

    /**
     * @throws Exception
     */
    public function __invoke(
        ArticleCreateServiceInterface $articleCreateService,
    ): Response
    {

        if(!$articleCreateService->createFromFile('/articles.txt'))
        {
            return $this->redirectToRoute('app_frontpage');
        }

        return $this->redirectToRoute('article.index', ['active' => 1]);

    }
}
