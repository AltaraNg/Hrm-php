<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    public function index(Request $request): Response
    {
        $roleQuery = Role::query();
        if ($request->has('name')  && $request->query('name') != null) {
          $roleQuery =  $roleQuery->where('name','LIKE', '%'. $request->query('name'). '%');
        }
        if ($request->has('permission') && $request->query('permission') != null){
            $roleQuery =  $roleQuery->withWhereHas('permissions', fn ($query) => $query->where('name','LIKE','%'. $request->query('permission') .'%'));
        }
        $roles = $roleQuery->with('permissions')->paginate(request('per_page'));
        return $this->sendSuccess([new RoleCollection($roles)], 'All roles fetched successfully');
    }

    /**
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name'],
            'permissions' => ['nullable', 'array', 'min:1'],
            'permissions.*' => ['required', 'integer', 'exists:permissions,id']
        ], ['name.unique' => 'Role with the supplied name already exists']);
        /** @var $role Role */
        $role = Role::create(['name' => $request->name]);
        $permissions = $request->input('permissions');
        if ($permissions && is_countable($permissions)) {
            $role->syncPermissions($permissions);
        }
        return $this->sendSuccess(['role' => new RoleResource($role->load('permissions'))], 'Role created successfully');
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
        return $this->sendSuccess(['role' => new RoleResource($role->load('permissions'))], 'Role created successfully');
    }

    public function destroy(Role $role): Response
    {
        $role->delete();
        return $this->sendSuccess([], 'Role deleted successfully');
    }
}
