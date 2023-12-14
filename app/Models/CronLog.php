<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CronLog extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'scheduler_id',
        'started_at',
        'ended_at',
        'cron_status_id',
        'exception'
    ];

    protected $casts = [
        'cron_status_id' => 'integer',
        'exception' => 'array'
    ];

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
        return $this->belongsTo(Scheduler::class, 'scheduler_id', 'uuid');
    }

    public function status()
    {
        return $this->belongsTo(CronStatus::class, 'cron_status_id');
    }

    // * helper method

    public function saveLog(array $data)
    {
        $data = (object)$data;
        $this->cron_status_id = $data?->cron_status_id ?? $this->cron_status_id;
        $this->exception = $data?->exception ?? $this->exception;
        $this->ended_at = in_array($this->cron_status_id, CronStatus::FINAL_STAGES) ? Carbon::now() : null;
        $this->save();
    }
}
