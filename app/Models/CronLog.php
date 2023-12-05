<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CronLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduler_id',
        'ref_id',
        'started_at',
        'ended_at',
        'cron_status_id',
        'exception'
    ];

    protected $casts = [
        'cron_status_id' => 'integer',
        'scheduler_id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->ref_id = $model->ref_id ?? Str::uuid();
        });
    }

    // * Mutators

    public function setExceptionAttribute($value)
    {
        if (!$value) return;

        return $this->attributes['exception'] = json_encode([
            'message' => $value->getMessage(),
            'trace' => $value->getTraceAsString(),
        ]);
    }

    // * Relations

    public function scheduler()
    {
        return $this->belongsTo(Scheduler::class);
    }

    public function status()
    {
        return $this->belongsTo(CronStatus::class, 'cron_status_id');
    }

    // * helper method

    public function saveLog(array $data)
    {
        $data = (object)$data;
        $clone = $this->replicate();
        $clone->cron_status_id = $data?->cron_status_id ?? $clone->cronStatus_id;
        $clone->exception = $data?->exception ?? $clone->error;
        $clone->save();
    }
}
