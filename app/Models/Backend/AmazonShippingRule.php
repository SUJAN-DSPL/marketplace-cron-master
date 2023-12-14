<?php

declare(strict_types=1);

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

final class AmazonShippingRule extends Model
{
    protected $connection = 'backend_mysql';

    public $timestamps = false;

    protected $primaryKey = 'rule_id';

    protected $table = 'amazon_shipping_rules';

    protected $fillable = [];
}
