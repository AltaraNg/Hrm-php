<?php

namespace App\Http\Controllers\Auth;

use App\Helper\HttpResponseCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\User;
use App\Repositories\Eloquent\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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
            //This line check if user has a role id attributed to it on the users table
            //if it has and doesn't have role associated to it by spatie role
            //we assign the user the role associated to it from the users table
            if ($user->roles()->doesntExist() && $user->role_id){
                //we are using sync here to make sure a user is not associated to more than one role
                //these syncRoles method first detach roles from the user, then assigns the passed role
                $user->syncRoles($user->role_id);
            }
            $token = $user->createToken('api-token')->plainTextToken;
            return $this->sendSuccess(['token' => $token, 'user' => new EmployeeResource($user->load('roles', 'roles.permissions'))], "Logged in successfully");
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
