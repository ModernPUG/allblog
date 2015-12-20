<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ArticleRepository;
use App\Entities\Article;

/**
 * Class ArticleRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ArticleRepositoryEloquent extends BaseRepository implements ArticleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Article::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function recentUpdatedArticles()
    {
        return $this->model->with('blog','tags')->orderBy('published_at', 'desc')->paginate(10);
    }

    public function recentUpdatedArticlesByTag(array $tags)
    {
        $articles = $this->model->with('blog','tags')->whereHas('tags', function ($q) use ($tags) {
            $q->whereIn('name', $tags);
        });

        return $articles->orderBy('published_at', 'desc')->paginate(10);
    }
}
