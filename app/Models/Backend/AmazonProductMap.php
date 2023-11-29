<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmazonProductMap extends Model
{
    use HasFactory;

    protected $connection = 'backend_mysql';
    protected $table = 'amazon_product_map';

    public $timestamps = false;
}
