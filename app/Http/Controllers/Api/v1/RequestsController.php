<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Mail\CustomMessage;
use App\Mail\RequestCreatedClient;
use App\Models\Category;
use App\Models\Request;
use App\Repositories\Contracts\CategoryRepository;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RequestUpdateRequest;
use App\Repositories\Contracts\RequestRepository;
use App\Validators\RequestValidator;

/**
 * Class RequestsController
 * @package App\Http\Controllers\Api
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
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * RequestsController constructor.
     * @param RequestRepository $repository
     * @param RequestValidator $validator
     * @param FileHelper $fileHelper
     */
    public function __construct(
        RequestRepository $repository,
        RequestValidator $validator,
        FileHelper $fileHelper,
        CategoryRepository $categoryRepository
    )
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->fileHelper  = $fileHelper;
        $this->categoryRepository  = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param HttpRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index(HttpRequest $request)
    {
        $data = $request->all();
        $user = Auth::user();

        $category = $this->categoryRepository->where('owner_email', 'LIKE', "%$user->email%")->first();

        $catId = '';
        if ($category) {
            $catId = $category->id;
        }

        $limit = Arr::get($data, 'limit', 20);
        $filter = Arr::get($data, 'filterStatus', '');
        $requestsModel = $this->repository
            ->filterByStatus($filter)
            ->whereIn('category_id', [$catId])
            ->paginate($limit);

        return response()->json([
            'data' => $requestsModel,
        ]);
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

        return response()->json([
            'data' => $request,
        ]);
    }

    /**
     * @param RequestUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function approve(RequestUpdateRequest $request)
    {
        try {

            $data = $request->all();
            $id = Arr::get($data, 'id');

            $requestModel = $this->repository->find($id);
            $requestModel->status = Request::STATUS_APPROVED;
            if (!$requestModel->save()) {
                throw new \Exception('Not saved');
            }

            $response = [
                'message' => 'Request updated.',
                'data'    => $requestModel->toArray(),
            ];

            $text = "Sizning maqolangiz qabul qilindi. Sizga to'lov xabari jo'natilinadi. Ma'lumot uchun +998937077371";

            Mail::to($requestModel->email)
                ->send(new CustomMessage($text));

            return response()->json($response);

        } catch (ValidatorException $e) {

            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * @param RequestUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel(RequestUpdateRequest $request)
    {
        try {

            $data = $request->all();
            $id = Arr::get($data, 'id');
            $answer_text = Arr::get($data, 'answer_text');

            $requestModel = $this->repository->find($id);
            $requestModel->status = Request::STATUS_NOT_APPROVED;
            $requestModel->answer_text = $answer_text;
            if (!$requestModel->save()) {
                throw new \Exception('Not saved');
            }

            $text = "Sizning maqolangiz qabul qilinmadi: " . PHP_EOL . $answer_text;

            Mail::to($requestModel->email)
                ->send(new CustomMessage($text));

            $response = [
                'message' => 'Request updated.',
                'data'    => $requestModel->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {

            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * @param RequestUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(RequestUpdateRequest $request)
    {
        try {
            $data = $request->all();
            $email = Arr::get($data, 'email');
            $text = Arr::get($data, 'text');

            Mail::to($email)
                ->send(new CustomMessage($text));

        } catch (ValidatorException $e) {

            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }
}
