<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ViewCountRepository;
use App\Entities\ViewCount;

/**
 * Class ViewCountRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ViewCountRepositoryEloquent extends BaseRepository implements ViewCountRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ViewCount::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
