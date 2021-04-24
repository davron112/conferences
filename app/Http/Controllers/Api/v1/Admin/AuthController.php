<?php
namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CustomMessage;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Class AuthController
 * @package App\Http\Controllers\Api\v1
 */
class AuthController extends Controller
{
    public $successStatus = 200;

    private $modelName = "Auth";

    /**
     * Sign up new user
     *
     * @param Request $request
     * @param Logger $log
     * @return \Illuminate\Http\JsonResponse
     */
    public function signUp(Request $request, Logger $log, UserRepository $userRepository)
    {
        $params = $request->all();
        $model = $userRepository->create($params);

        if ($model){
            $message = $this->modelName .' was successfully stored.';
            $log->info($message, ['id' => $model->id]);
            $data = $this->successResponse($this->modelName, $model, $message);
        } else {
            $message = $this->modelName.' was not stored.';
            $log->error($message);
            $data = $this->errorResponse($this->modelName, null, $message);
        }

        return response()->json($data, $data['code']);
    }

    /**
     * Login user and create token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $data = $request->all();

        if(Auth::attempt(['email' => trim($data['email']), 'password' => trim($data['password'])])){
            /** @var User $user */
            $user = Auth::user();
            $success['userData'] =  [
                'uid' => $user->id,          // From Auth
                'displayName' => $user->name, // From Auth
                'about'=> 'Dessert chocolate cake lemon drops jujubes. Biscuit cupcake ice cream bear claw brownie brownie marshmallow.',
                'photoURL' => 'https://static.vecteezy.com/system/resources/thumbnails/000/550/980/small/user_icon_001.jpg', // From Auth
                'status' => $user->email,
                'userRole' => $user->role
            ];
            $success['accessToken'] =  $user->createToken('MyApp')->accessToken;
            return response()->json($success);
        }
        else{
            return response()->json(
                ['message' => 'Unauthorised', 'status' => 'error']
            , 200);
        }
    }

    public function sendLoginOtp(Request $request) {
        $data = $request->all();
        $email = Arr::get($data, 'email');
        $otpCode = Str::random(8);

        $user = User::firstOrCreate(['email' => $email], [
            'name' => Str::random(8),
            'status' => 'ACTIVE',
            'password' => Hash::make($otpCode)
        ]);

        $textMail= "Siz conferences-list.uz saytidan ro'yxatdan o'tdingiz. Maxfiy parolingiz: : " . $otpCode . " . Kodni hech kimga jo'natmang! conferences-list.uz";
        Mail::to($user->email)
            ->send(new CustomMessage($textMail));
    }

    /**
     * Logout user (Revoke the token)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }
}
