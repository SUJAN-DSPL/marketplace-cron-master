<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CronJob extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $fillable = [
        'name',
        'path',
        'description',
        'cron_type_id',
        'allocation_id',
    ];

    protected $casts = [
        'cron_type_id' => 'integer',
        'allocation_id' => 'integer',
    ];


    // * Relations

    public function cronType()
    {
        return $this->belongsTo(CronType::class);
    }

    public function allocation()
    {
        return $this->belongsTo(Allocation::class);
    }
}
