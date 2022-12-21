<?php

namespace App\Http\Controllers;

use App\Helper\HttpResponseCodes;
use App\Http\Resources\EmployeeResource;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RolePermissionController extends Controller
{
    /**
 * @throws ValidationException
 */
    public function assignPermissionsToRole(Request $request, Role $role): \Illuminate\Http\Response
    {
        $this->validate($request, [
            'permissions' => ['required', 'array', 'min:1'],
            'permissions*' => ['required', 'integer', 'exists:permissions,id'],
        ]);
        $role->syncPermissions($request->input('permissions'));

        return $this->sendSuccess(['roles' => $role]);
    }

    /**
     * @throws ValidationException
     */
    public function assignRoleToUser(Request $request, User $user): \Illuminate\Http\Response
    {
        
        $this->validate($request, [
            'role' => ['required', 'integer'],
        ]);
        $role = Role::findById($request->role);
        if (!$role) {
            return $this->sendError('The supplied role id does not exists', HttpResponseCodes::BAD_REQUEST);
        }
        $user->syncRoles($role);
        return $this->sendSuccess(['user' => new EmployeeResource($user)]);
    }
}
