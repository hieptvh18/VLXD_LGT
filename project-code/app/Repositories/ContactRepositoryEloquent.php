<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\ContactRepository;
use App\Models\Contact;
use App\Validators\ContactValidator;

/**
 * Class ContactRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ContactRepositoryEloquent extends BaseRepository implements ContactRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Contact::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
