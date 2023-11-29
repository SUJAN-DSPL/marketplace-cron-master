<?php

namespace App\Models;

use DateTimeZone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scheduler extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'is_active',
        'cron_job_id',
        'timezone'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'cron_job_id' => 'integer'
    ];


    // * Relations

    public function cronjob()
    {
        $this->belongsTo(cronjob::class);
    }

    // DateTimeZone::listIdentifiers(DateTimeZone::ALL);
}
