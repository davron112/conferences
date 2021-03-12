<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ConferenceRepository;
use App\Validators\RequestValidator;

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
     */
    public function __construct(
        ConferenceRepository $repository,
        RequestValidator $validator
    )
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $conferences = $this->repository->orderBy('created_at', 'DESC')->paginate(20);

        return response()->json($conferences);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $conference = $this->repository->find($id);

        return response()->json($conference);
    }
}
