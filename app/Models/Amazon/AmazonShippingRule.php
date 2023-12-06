<?php

declare(strict_types=1);

namespace App\Models\Amazon;

use Illuminate\Database\Eloquent\Model;

final class AmazonShippingRule extends Model
{
    protected $connection = 'live_site';

    public $timestamps = false;

    protected $primaryKey = 'rule_id';

    protected $table = 'amazon_shipping_rules';

    protected $fillable = [];
}
