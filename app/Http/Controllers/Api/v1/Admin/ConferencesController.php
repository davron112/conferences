<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\ConferenceRepository;
use App\Validators\RequestValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * Class RequestsController
 * @package App\Http\Controllers\Api
 */
class ConferencesController extends Controller
{
    /**
     * @var ConferenceRepository
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
     * @param ConferenceRepository $repository
     * @param RequestValidator $validator
     * @param FileHelper $fileHelper
     */
    public function __construct(
        ConferenceRepository $repository,
        RequestValidator $validator,
        FileHelper $fileHelper
    )
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->fileHelper  = $fileHelper;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $requestsModel = $this->repository->paginate(Arr::get($data, 'limit', 20));

        return response()->json([
            'data' => $requestsModel,
        ]);
    }



    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = $this->repository->find($id);

        return response()->json([
            'data' => $user,
        ]);
    }
}
