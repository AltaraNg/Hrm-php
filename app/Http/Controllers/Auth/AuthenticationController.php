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
        if (Auth::attempt(['staff_id' => $request->staff_id, 'password' => $request->password])) {
            /**
             * @var User $user
             */
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;
            return $this->sendSuccess(['token' => $token, 'user' => $user]);
        }else {
            return $this->sendError('Invalid email or password supplied', HttpResponseCodes::LOGIN_FAIL);
        }
    }

    public  function logout(Request $request): Response
    {
        /** @var  User $user*/
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return $this->sendSuccess([], 'You have been successfully logged out');
    }

}
