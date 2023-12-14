<?php

namespace App\Enums\CronJob;

enum CronTypeEnum: string
{
    case EXTERNAL = 'external';

    case INTERNAL = 'internal';

    case AFFILIATE = 'affiliate';

    case GOOGLE = 'google';

    case WAREHOUSE = 'warehouse';

    case CUSTOMER = 'customer';

    case OTHER = 'other';
}
