<?php

declare(strict_types=1);

namespace App\Domain\RepositoryFilter\Article;

class ArticleFilter
{
    /**
     * @param bool|null $active
     */
    public function __construct(
        public ?bool $active = true,
    ) {
    }
}
