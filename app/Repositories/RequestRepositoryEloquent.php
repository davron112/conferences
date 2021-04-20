<?php

namespace App\Repositories;

use App\Repositories\Criteria\ConferenceCriteria;
use App\Repositories\Criteria\StatusesCreteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\RequestRepository;
use App\Models\Request;
use App\Validators\RequestValidator;

/**
 * Class RequestRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RequestRepositoryEloquent extends BaseRepository implements RequestRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Request::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RequestValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param string $status
     * @return $this
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function filterByStatus($status = '')
    {
        $this->status = $status;
        $this->pushCriteria(app(StatusesCreteria::class));
        return $this;
    }

    /**
     * @param string $status
     * @return $this
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function filterByConference($id = '')
    {
        if ($id) {
            $this->conference_id = $id;
            $this->pushCriteria(app(ConferenceCriteria::class));
        }
        return $this;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function filterCategory($id = '')
    {
        if ($id) {
            $this->findWhere([
                'category_id' => $id
            ]);
        }
        return $this;
    }

}
