<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Filters\UserBuilder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * User model class
 * @package App\Models
 * @property-read  int $id
 * @property int $role_id
 * @property int $staff_id
 * @property string $full_name
 * @property Carbon $date_of_appointment
 * @property Carbon $date_of_exit
 * @property string $status
 * @property string $category
 * @property string $phone_number
 * @property string $highest_qualification
 * @property int $branch_id
 * @property string $password;
 * @property string $gender
 * @property string $referee_1
 * @property string $referee_2
 * @property string $referee_1_phone_no
 * @property string $referee_2_phone_no
 * @property Carbon $date_of_birth
 * @property int $age
 * @property int $hr_id
 * @property string $nationality
 * @property string $next_of_kin_name
 * @property string $next_of_kin_phone_no
 * @property string $guarantor_name
 * @property int $portal_access
 * @property string $api_token
 * @property string $remember_token
 * @property string $guarantor_phone_no
 * @property string $guarantor_address
 * @property string $guarantor_relationship
 * @property string $guarantor_name_2
 * @property string $guarantor_phone_no_2
 * @property string $guarantor_address_2
 * @property string $guarantor_relationship_2
 * @property string $cv_url
 *
 * @property-read  Carbon $created_at
 * @property-read  Carbon $updated_at
 * Relationships
 * @property Branch $branch
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
        'hr_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'date_of_birth' => 'date',
        'portal_access' => 'boolean',
        'date_of_appointment' => 'date:Y-m-d',
        'date_of_exit' => 'date'
    ];
    protected $guard_name = 'sanctum';
    public function getAgeAttribute(): ?int
    {
        return $this->date_of_birth?->diffInYears(Carbon::now());
    }

    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class,);
    }

}
