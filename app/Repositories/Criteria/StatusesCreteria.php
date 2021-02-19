<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;

class StatusesCreteria extends RequestCriteria
{
    public function apply($model , RepositoryInterface $repository)
    {
        $status = $repository->status;

        if ($status) {
            return $model->where('status', $status);
        }
        return $model;
    }
}
