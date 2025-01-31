<?php

declare(strict_types=1);

namespace App\Domain\Repository\Article;

use App\Domain\Entity\Article\Article;
use App\Domain\RepositoryFilter\Article\ArticleFilter;
use DomainException;

interface ArticleRepositoryInterface
{
    /**
     * Найти пользователя по фильтру
     *
     * @param ArticleFilter $filter
     *
     * @return array
     */
    public function findArticles(ArticleFilter $filter): array;

    /**
     * Найти пользователя по slug
     *
     * @param string $slug
     *
     * @return Article
     *
     * @throws DomainException
     */
    public function findBySlug(string $slug): Article;

    /**
     * Сохранить пользователя
     *
     * @param Article $article
     *
     * @return void
     */
    public function save(Article $article): void;

    /**
     * Удалить пользователя
     *
     * @param Article $article
     *
     * @return void
     */
    public function delete(Article $article): void;


    /**
     * Проверить существует такой заголовок
     *
     * @param string $title
     *
     * @return bool
     */
    public function titleExist(string $title): bool;
}
