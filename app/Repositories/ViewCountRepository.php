<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ViewCountRepository
 * @package namespace App\Repositories;
 */
interface ViewCountRepository extends RepositoryInterface
{
    public function getLastBestArticlesByTags($lastDays, $tagIds);
}
