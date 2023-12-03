<?php

namespace App\Services;

use App\Models\Scheduler;

class SchedulerService
{
    const Model = Scheduler::class;

    public function __construct(public null|Scheduler $scheduler = null)
    {
    }

    public function create(array $data): Scheduler
    {
        $this->scheduler = self::Model::query()->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'cron_job_class' => $data['cron_job_class'],
            'timezone' => $data['timezone'],
            'notifiable_emails' => $data['notifiable_emails'],
            'notify_on_slack' => $data['notify_on_slack'],
            'is_active' => $data['is_active']
        ]);

        return $this->scheduler;
    }
}
