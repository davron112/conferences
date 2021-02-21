<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Mail\CustomMessage;
use App\Mail\PaymentMessage;
use App\Mail\RequestCreatedClient;
use App\Mail\ReUploadMessage;
use App\Models\Category;
use App\Models\Request;
use App\Repositories\Contracts\CategoryRepository;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RequestUpdateRequest;
use App\Repositories\Contracts\RequestRepository;
use App\Validators\RequestValidator;

/**
 * Class RequestsController
 * @package App\Http\Controllers\Api\v1
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
     *
     * @param RequestRepository $repository
     * @param RequestValidator $validator
     * @param FileHelper $fileHelper
     * @param CategoryRepository $categoryRepository
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
        $new = Request::where('status', Request::STATUS_NEW)->where('category_id', $catId)->count();
        $approved = Request::where('status', Request::STATUS_APPROVED)->where('category_id', $catId)->count();
        $not_approved = Request::where('status', Request::STATUS_NOT_APPROVED)->where('category_id', $catId)->count();
        $fail = Request::where('status', Request::STATUS_FAIL)->where('category_id', $catId)->count();
        $re_upload = Request::where('status', Request::STATUS_RE_UPLOAD)->where('category_id', $catId)->count();
        $paid = Request::where('payment_status', Request::PAYMENT_STATUS_PAID)->where('category_id', $catId)->count();
        $un_paid = Request::where('payment_status', Request::PAYMENT_STATUS_UNPAID)->where('category_id', $catId)->count();
        $sent = Request::where('payment_status', Request::PAYMENT_STATUS_SENT)->where('category_id', $catId)->count();

        return response()->json([
            'data' => $requestsModel,
            'counts' => [
                'new' => $new,
                'approved' => $approved,
                'not_approved' => $not_approved,
                'paid' => $paid,
                'un_paid' => $un_paid,
                're_upload' => $re_upload,
                'fail' => $fail,
            ],
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

            $text = "Sizning #" . $requestModel->id . " raqamli maqolangiz qabul qilindi. Sizga to'lov xabari jo'natilinadi. Ma'lumot uchun +998937077371";

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
    public function fail(RequestUpdateRequest $request)
    {
        try {
            $data = $request->all();
            $id = Arr::get($data, 'id');

            $requestModel = $this->repository->find($id);
            $requestModel->status = Request::STATUS_FAIL;
            if (!$requestModel->save()) {
                throw new \Exception('Not saved');
            }

            $response = [
                'message' => 'Request updated.',
                'data'    => $requestModel->toArray(),
            ];

            $text = "Sizning #" . $requestModel->id . " raqamli maqolangiz texnik xatolik sababidan bekor qilindi. Ma'lumot uchun +998937077371";

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

            $text = "Sizning #" . $requestModel->id . " raqamli maqolangiz qabul qilinmadi: " . PHP_EOL . $answer_text;

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

    /**
     * @param RequestUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function reUploadMessage(RequestUpdateRequest $request)
    {
        try {
            $data = $request->all();
            $id = Arr::get($data, 'id');
            $text = Arr::get($data, 'text');
            $requestModel = $this->repository->find($id);

            Mail::to($requestModel->email)
                ->send(new ReUploadMessage($requestModel->hash, $text));

            $requestModel->status = Request::STATUS_RE_UPLOAD;

            if (!$requestModel->save()) {
                throw new \Exception('Not saved');
            }
            $response = [
                'message' => 'Request updated.',
                'data'    => $requestModel->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {
            Log::error('Not changed reupload status', [
                'message' => $e->getMessage(),
                'error' => $e
            ]);
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * @param RequestUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function paymentSent(RequestUpdateRequest $request)
    {
        try {
            $data = $request->all();
            $id = Arr::get($data, 'id');
            $link = Arr::get($data, 'text');
            $requestModel = $this->repository->find($id);

            Mail::to($requestModel->email)
                ->send(new PaymentMessage($requestModel->id, $link));

            $requestModel->payment_status = Request::PAYMENT_STATUS_SENT;
            $requestModel->payment_link = $link;

            if (!$requestModel->save()) {
                throw new \Exception('Not saved');
            }
            $response = [
                'message' => 'Request updated.',
                'data'    => $requestModel->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {
            Log::error('Not changed payment status', [
                'message' => $e->getMessage(),
                'error' => $e
            ]);
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }
}
