<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    use HasFactory;

    protected $table = "order_log";
    protected $connection = 'backend_mysql';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'order_status',
        'description',
        'date',
        'processed_by',
        'processed_by_supp',
        'order_suspended_reason'
    ];
}
