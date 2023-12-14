<?php

namespace App\Enums\CronJob;

enum CronAllocationEnum: string
{
    case WEBSITE = 'website';

    case MARKETPLACE = 'marketplace';

    case BOTH = 'both';
}
