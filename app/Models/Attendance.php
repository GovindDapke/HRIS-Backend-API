<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
 
    // protected $fillable = ['employee_id'];
    protected $fillable = ['employee_id', 'date', 'status', 'temperature', 'spo2', 'heart_rate', 'mood', 'login_time', 'logout_time'];

    use HasFactory, SoftDeletes;
    public function employees()
    {
        return $this->belongsTo(User::class,'id','employee_id');
    }
}
