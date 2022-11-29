<?php

namespace App\Http\Controllers;

use App\Models\Role;
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
            'role' => ['required', 'integer', 'exists:roles,id'],
        ]);
        $user->syncRoles($request->input('role'));

        return $this->sendSuccess(['roles' => $role]);
    }
}
