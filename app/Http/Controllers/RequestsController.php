<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Mail\RequestCreatedAdmin;
use App\Mail\RequestCreatedClient;
use App\Models\UserFile;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RequestCreateRequest;
use App\Http\Requests\RequestUpdateRequest;
use App\Repositories\Contracts\RequestRepository;
use App\Validators\RequestValidator;

/**
 * Class RequestsController.
 *
 * @package namespace App\Http\Controllers;
 */
class RequestsController extends Controller
{
    /**
     * @var RequestRepository
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
     * @param RequestRepository $repository
     * @param RequestValidator $validator
     * @param FileHelper $fileHelper
     */
    public function __construct(
        RequestRepository $repository,
        RequestValidator $validator,
        FileHelper $fileHelper
    )
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->fileHelper  = $fileHelper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $requests = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $requests,
            ]);
        }

        return view('requests.index', compact('requests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RequestCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(RequestCreateRequest $request)
    {
        try {
            $data = $request->all();
            $uploadedImage = Arr::get($data, 'file');
            if ($uploadedImage) {
                $data['file'] = $this->fileHelper->upload($uploadedImage, 'files');
            }
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $requestModel = $this->repository->create($data);

            Mail::to($requestModel->email)
                ->send(new RequestCreatedClient($requestModel));

            Mail::to($requestModel->category->owner_email)
                ->send(new RequestCreatedAdmin($requestModel));
            $requestModel->send_owner = 1;
            $requestModel->send_user = 1;
            $requestModel->save();
            $response = [
                'message' => 'Sizning maqolangiz ko\'rib chiqish uchun qabullandi. Javob xabarini email orqali olasiz.',
                'data'    => $requestModel->toArray(),
            ];

            return view('registration', $response);
        } catch (ValidatorException $e) {


            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RequestCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function reUpload(RequestCreateRequest $request)
    {
        try {
            $data = $request->all();
            if ($request->isMethod('GET')) {
                return view('change');
            }
            $hash = Arr::get($data, 'hash');
            $requestModel = \App\Models\Request::where('hash', $hash)->first();
            $uploadedImage = Arr::get($data, 'file');
            $data['version'] = Arr::get($data, 'version', rand(1, 999));
            $data['type'] = 'FILE';
            $data['request_id'] = $requestModel->id;

            if ($uploadedImage) {
                $data['file_path'] = $this->fileHelper->upload($uploadedImage, 'files');
            }

            $fileData = UserFile::create($data);

            /*Mail::to($fileData->email)
                ->send(new RequestCreatedClient($requestModel));

            Mail::to($requestModel->category->owner_email)
                ->send(new RequestCreatedAdmin($requestModel));*/

            $response = [
                'message' => 'Sizning maqolangiz ko\'rib chiqish uchun qabullandi. Javob xabarini email orqali olasiz.',
                'data'    => $fileData->toArray(),
            ];

            return view('change', $response);
        } catch (ValidatorException $e) {
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
        $request = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $request,
            ]);
        }

        return view('requests.show', compact('request'));
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
        $request = $this->repository->find($id);

        return view('requests.edit', compact('request'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RequestUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RequestUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $request = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Request updated.',
                'data'    => $request->toArray(),
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
                'message' => 'Request deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Request deleted.');
    }
}
