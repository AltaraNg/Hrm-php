<?php

namespace App\Http\Controllers\Auth;

use App\Helper\HttpResponseCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Repositories\Eloquent\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(private readonly UserRepository $userRepository){}

    /**
     * @param LoginRequest $request
     * @return Response
     */
    public function login(LoginRequest $request): Response
    {
//        $data = (object)$request->validated();
        if (Auth::attempt(['staff_id' => $request->staff_id, 'password' => $request->password])) {
            /**
             * @var User $user
             */
            $user = Auth::user();
//            dd($user);
            $token = $user->createToken('api-token')->accessToken;
            return $this->sendSuccess(['token' => $token, 'user' => $user]);
        }else{
            return  $this->sendError('Invalid email or password supplied', HttpResponseCodes::LOGIN_FAIL);
        }

    }
}
