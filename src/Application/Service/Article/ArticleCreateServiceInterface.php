<?php

declare(strict_types=1);

namespace App\Application\Service\Article;

use Exception;

interface ArticleCreateServiceInterface
{
    public function create(string $filename): bool;

    /**
     * @param array $articles
     * @return false
     * @throws Exception
     */
    public function createDto(array $articles): bool;

}
