<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ConferenceCreateRequest;
use App\Http\Requests\ConferenceUpdateRequest;
use App\Repositories\Contracts\ConferenceRepository;
use App\Validators\ConferenceValidator;

/**
 * Class ConferencesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ConferencesController extends Controller
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

        return view('conferences.index', compact('conferences'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ConferenceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ConferenceCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $conference = $this->repository->create($request->all());

            $response = [
                'message' => 'Conference created.',
                'data'    => $conference->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conference = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $conference,
            ]);
        }

        return view('conferences.show', compact('conference'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conference = $this->repository->find($id);

        return view('conferences.edit', compact('conference'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ConferenceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ConferenceUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $conference = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Conference updated.',
                'data'    => $conference->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Conference deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Conference deleted.');
    }
}
