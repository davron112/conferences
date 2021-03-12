<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestCreateRequest;
use App\Mail\RequestCreatedClient;
use App\Repositories\Contracts\CategoryRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
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
     * @param RequestCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
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

           /* Mail::to($requestModel->category->owner_email)
                ->send(new RequestCreatedAdmin($requestModel));
            $requestModel->send_owner = 1;*/
            $requestModel->send_user = 1;
            $requestModel->save();
            $response = [
                'message' => 'Sizning maqolangiz ko\'rib chiqish uchun qabullandi. Javob xabarini email orqali olasiz.',
                'data'    => $requestModel->toArray(),
            ];

            return response()->json($response);
        } catch (ValidatorException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
