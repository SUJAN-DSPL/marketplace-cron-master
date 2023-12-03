<?php

namespace App\Models;

use DateTimeZone;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scheduler extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'cron_job_class',
        'timezone',
        'notifiable_emails',
        'notify_on_slack'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'notify_on_slack' => 'boolean',
        'notifiable_emails' => 'array',
    ];

    // * scopes

    public function scopeActive($query)
    {
        $query->where('is_active', true);
    }


    // * Relations

    public function frequencies()
    {
        return $this->belongsToMany(
            Frequency::class,
            'scheduler_frequencies',
            'scheduler_id',
            'frequency_id'
        )->withPivot('frequency_params');
    }

    public function cronLogs()
    {
        return $this->hasMany(CronLog::class, 'scheduler_id', 'uuid');
    }


    // * helper methods

    public function addFrequencies(array $frequencies): void
    {
        array_walk($frequencies, function ($frequency) {
            $this->frequencies()->attach(
                $frequency['frequency_id'],
                ['frequency_params' => json_encode($frequency['frequency_params'])]
            );
        });
    }

    public function initLog($statusId = CronStatus::DRAFT)
    {
        return $this->cronLogs()->create([
            'started_at' => Carbon::now(),
            'cron_status_id' => $statusId
        ]);
    }
}
