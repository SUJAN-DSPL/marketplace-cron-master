<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronStatus extends Model
{
    use HasFactory;

    const DRAFT = 1;
    const RUNNING = 2;
    const COMPLETED = 3;
    const FAILED = 4;

    protected $fillable = [
        'id',
        'label',
        'description',
    ];
}
