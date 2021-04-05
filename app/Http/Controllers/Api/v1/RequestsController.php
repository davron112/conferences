<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\FileHelper;
use App\Helpers\SmsSend;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestCreateRequest;
use App\Mail\CustomMessage;
use App\Mail\RequestCreatedClient;
use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;
use App\Repositories\Contracts\CategoryRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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
            $otp_code = rand(11111, 99999);
            $data['otp_code'] = $otp_code;
            $data['phone'] = preg_replace('#[^\d]#', '', Arr::get($data, 'phone'));
            $data['otp_session'] = Str::random(8);
            $data['status'] = Request::STATUS_PENDING;
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $requestModel = $this->repository->create($data);

           /* Mail::to($requestModel->category->owner_email)
                ->send(new RequestCreatedAdmin($requestModel));
            $requestModel->send_owner = 1;*/
            $requestModel->send_user = 1;

            if (!$requestModel->save()) {
                throw new \Exception('Not saved');
            }
            $textMail= "Tasdiqlash kodi: " . $otp_code . " conferences-list.uz";
            $textSms= "Tasdiqlash kodi: " . $otp_code . " conferences-list.uz";

            SmsSend::sendSms(preg_replace('#[^\d]#', '', $requestModel->phone), $textSms);
            Mail::to($requestModel->email)
                ->send(new CustomMessage($textMail));


            $response = [
                'message' => 'Tasdiqlash kodi sms yoki email orqali jo\'natilindi. Maqolangiz qabul qilinishi uchun uni tasdiqlashingiz kerak.',
                'data' => [
                    'id'    => $requestModel->id,
                    'otp_session'    => $requestModel->otp_session,
                    'email'    => '**********'. substr($requestModel->email, -6),
                    'phone'    => '**********'. substr($requestModel->phone, -4),
                ]
            ];

            return response()->json($response);
        } catch (ValidatorException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function checkOtp(HttpRequest $request) {
        $data = $request->all();
        $requestModel = $this->repository->find($data['id']);
        if ($requestModel->otp_code == $data['otp_code']
            && $requestModel->otp_session == $data['otp_session']
        ) {
            $requestModel->status = Request::STATUS_NEW;
            $requestModel->save();
            Mail::to($requestModel->email)
                ->send(new RequestCreatedClient($requestModel));
            SmsSend::sendSms(preg_replace('#[^\d]#', '', $requestModel->phone), "Maqolangiz tasdiqlandi. conferences-list.uz");
            return response()->json([
                'message' => 'Muoffaqiyatli tasdiqlandi.',
                'status' => true,
                'data' => $requestModel
            ]);
        } else {
            return response()->json([
                'message' => 'Tasdiqlash kodi noto\'g\'ri',
                'status' => false
            ]);
        }
    }
}
