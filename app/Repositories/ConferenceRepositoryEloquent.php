<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ConferenceRepository;
use App\Models\Conference;
use App\Validators\ConferenceValidator;

/**
 * Class ConferenceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ConferenceRepositoryEloquent extends BaseRepository implements ConferenceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Conference::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ConferenceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
