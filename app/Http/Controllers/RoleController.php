<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    public function index(): Response
    {
        return $this->sendSuccess(['roles' => RoleResource::collection(Role::all())]);
    }

    /**
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name']
        ], ['name.unique' => 'Role with the supplied name already exists']);
        $role = Role::create(['name' => $request->name]);
        return $this->sendSuccess(['role' => new RoleResource($role)], 'Role created successfully');
    }

    public function show(Request $request, Role $role): Response
    {
        return $this->sendSuccess(['role' => $role]);
    }

    public function update(Request $request, Role $role): Response
    {
        $request->validate([
            'name' => ['required', 'string', Rule::unique('roles', 'name')->ignore($role->id)]
        ], ['name.unique' => 'Role with the supplied name already exists']);
        $role->name = $request->name;
        $role->save();
        return $this->sendSuccess(['role' => new RoleResource($role)], 'Role created successfully');
    }

    public function destroy(Role $role): Response
    {
        $role->delete();
        return $this->sendSuccess([], 'Role deleted successfully');
    }
}
