<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function index(): Response
    {
        return $this->sendSuccess(['permissions' => PermissionResource::collection(Permission::all())]);
    }

    /**
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:permissions,name']
        ], ['name.unique' => 'Permission with the supplied name already exists']);
        $role = Permission::create(['name' => $request->name]);
        return $this->sendSuccess(['role' => new PermissionResource($role)], 'Role created successfully');
    }
//
    public function show(Request $request, Permission $permission): Response
    {
        return $this->sendSuccess(['permission' => new PermissionResource($permission)]);
    }

    public function update(Request $request, Permission $permission): Response
    {
        $request->validate([
            'name' => ['required', 'string', Rule::unique('permissions', 'name')->ignore($permission->id)]
        ], ['name.unique' => 'Role with the supplied name already exists']);
        $permission->name = $request->name;
        $permission->save();
        return $this->sendSuccess(['role' => new PermissionResource($permission)], 'Role created successfully');
    }

    public function destroy(Permission $permission): Response
    {
        $permission->delete();
        return $this->sendSuccess([], 'Permission deleted successfully');
    }
}
