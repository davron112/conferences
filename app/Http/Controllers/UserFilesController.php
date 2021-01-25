<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserFileCreateRequest;
use App\Http\Requests\UserFileUpdateRequest;
use App\Repositories\Contracts\UserFileRepository;
use App\Validators\UserFileValidator;

/**
 * Class UserFilesController.
 *
 * @package namespace App\Http\Controllers;
 */
class UserFilesController extends Controller
{
    /**
     * @var UserFileRepository
     */
    protected $repository;

    /**
     * @var UserFileValidator
     */
    protected $validator;

    /**
     * UserFilesController constructor.
     *
     * @param UserFileRepository $repository
     * @param UserFileValidator $validator
     */
    public function __construct(UserFileRepository $repository, UserFileValidator $validator)
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
        $userFiles = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userFiles,
            ]);
        }

        return view('userFiles.index', compact('userFiles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserFileCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UserFileCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $userFile = $this->repository->create($request->all());

            $response = [
                'message' => 'UserFile created.',
                'data'    => $userFile->toArray(),
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
        $userFile = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userFile,
            ]);
        }

        return view('userFiles.show', compact('userFile'));
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
        $userFile = $this->repository->find($id);

        return view('userFiles.edit', compact('userFile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserFileUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UserFileUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $userFile = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'UserFile updated.',
                'data'    => $userFile->toArray(),
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
                'message' => 'UserFile deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UserFile deleted.');
    }
}
