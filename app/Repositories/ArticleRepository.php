<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ArticleRepository
 * @package namespace App\Repositories;
 */
interface ArticleRepository extends RepositoryInterface
{
    public function recentUpdatedArticles();
    public function recentUpdatedArticlesByTag(array $tags);
}
