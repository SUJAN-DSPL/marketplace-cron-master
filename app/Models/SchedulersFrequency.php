<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchedulersFrequency extends Model
{
    use HasFactory;

    public $fillable = [
        'frequency_id',
        'frequency_params',
        'scheduler_id'
    ];

    protected $casts = [
        'frequency_params' => 'array',
    ];


    // * Relations

    public function frequency()
    {
        return $this->belongsTo(Frequency::class);
    }

    public function scheduler()
    {
        return $this->belongsTo(Scheduler::class);
    }
}
