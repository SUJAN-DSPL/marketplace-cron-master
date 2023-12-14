<?php

namespace App\Enums\CronJob;

enum CronStatusEnum: string
{
    case SUCCESS = 'success';

    case FAILED = 'failed';
}
