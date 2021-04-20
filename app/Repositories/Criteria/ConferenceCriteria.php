<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;

class ConferenceCriteria extends RequestCriteria
{
    public function apply($model , RepositoryInterface $repository)
    {
        $conferenceId = $repository->conference_id;

        if ($conferenceId) {
            return $model->where('conference_id', $conferenceId);
        }
        return $model;
    }
}
