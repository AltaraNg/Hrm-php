<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * @property-read int $id;
 * @property string $name;
 * @property-read string $guard_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * Relationships
 * @property Collection<Role> $roles
 * */
class Permission extends SpatiePermission
{
    use HasFactory;
    protected $hidden = ['guard_name'];
    protected  $with = ['roles'];
}
