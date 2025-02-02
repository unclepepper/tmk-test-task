<?php

declare(strict_types=1);

namespace App\Application\Service\Article;

use Exception;

interface ArticleCreateServiceInterface
{
    public function createFromFile(string $path): bool;

    /**
     * @param array<string, mixed> $articles
     * * @return bool
     * * @throws Exception
 */
    public function createDto(array $articles): bool;

}
