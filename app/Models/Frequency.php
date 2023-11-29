<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequency extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'method',
        'params_details',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'params_details' => 'array',
    ];
}


