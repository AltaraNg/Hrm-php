<?php

namespace App\Http\Controllers;

use App\Models\Role;
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
}
