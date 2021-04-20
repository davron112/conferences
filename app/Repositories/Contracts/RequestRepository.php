<?php

namespace App\Repositories\Contracts;

use App\Repositories\RequestRepositoryEloquent;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RequestRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface RequestRepository extends RepositoryInterface
{
    /**
     * @param string $status
     * @return $this
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function filterByStatus($status = '');
    public function filterByConference($id = '');
}
