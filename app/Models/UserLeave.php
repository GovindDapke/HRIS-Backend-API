<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserLeave extends Model
{
    use HasFactory,SoftDeletes;
    public function employees()
    {
        return $this->belongsTo(User::class,'id','employee_id');
    }
}
