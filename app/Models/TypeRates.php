<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRates extends Model
{
    use HasFactory;

    public function typeValuation()
    {
        return $this->belongsTo(TypeRates::class);
    }
}
