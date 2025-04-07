<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\SettingRepositoryRepository;
use App\Models\Setting;

/**
 * Class SettingRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SettingRepositoryRepositoryEloquent extends BaseRepository implements SettingRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Setting::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
