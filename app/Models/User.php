<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
