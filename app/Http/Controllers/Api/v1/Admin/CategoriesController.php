<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepository;
use App\Validators\RequestValidator;

/**
 * Class RequestsController
 * @package App\Http\Controllers\Api
 */
class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $repository;

    /**
     * @var RequestValidator
     */
    protected $validator;

    /**
     * @var FileHelper
     */
    protected $fileHelper;

    /**
     * RequestsController constructor.
     * @param CategoryRepository $repository
     * @param RequestValidator $validator
     * @param FileHelper $fileHelper
     */
    public function __construct(
        CategoryRepository $repository,
        RequestValidator $validator,
        FileHelper $fileHelper
    )
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->fileHelper  = $fileHelper;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $requestsModel = $this->repository->all();

        return response()->json([
            'data' => $requestsModel,
        ]);
    }
}
