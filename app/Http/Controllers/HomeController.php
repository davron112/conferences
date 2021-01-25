<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ConferenceRepository;
use App\Validators\ConferenceValidator;

/**
 * Class ConferencesController.
 *
 * @package namespace App\Http\Controllers;
 */
class HomeController extends Controller
{
    /**
     * @var ConferenceRepository
     */
    protected $repository;

    /**
     * @var ConferenceValidator
     */
    protected $validator;

    /**
     * ConferencesController constructor.
     *
     * @param ConferenceRepository $repository
     * @param ConferenceValidator $validator
     */
    public function __construct(ConferenceRepository $repository, ConferenceValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $conferences = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $conferences,
            ]);
        }

        return view('welcome', compact('conferences'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registration()
    {
        return view('registration', [
            'message' => ''
        ]);
    }
}
