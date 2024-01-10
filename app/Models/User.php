<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'employee_number'
    ];

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



    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }
    public function userdocument()
    {
        return $this->hasMany(UserDocument::class, 'employee_id');
    }
    public function userasset()
    {
        return $this->hasMany(UserAsset::class, 'employee_id');
    }

    public function userleave()
    {
        return $this->hasMany(UserLeave::class, 'employee_id');
    }

    public function educationDetails()
    {
        return $this->hasMany(EducationDetail::class, 'employee_id');
    }

    public function familyDetails()
    {
        return $this->hasOne(FamilyDetails::class, 'employee_id');
    }
}
