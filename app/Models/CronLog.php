<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduler_id',
        'started_at',
        'ended_at',
        'cron_status_id',
        'errors'
    ];

    protected $casts = [
        'errors' => 'array',
        'cron_status_id' => 'integer',
        'scheduler_id' => 'integer',
    ];


    // * Relaitons

    public function scheduler()
    {
        return $this->belongsTo(Scheduler::class);
    }

    public function status()
    {
        return $this->belongsTo(CronStatus::class, 'cron_status_id');
    }

    
    // * Database Actions


}
