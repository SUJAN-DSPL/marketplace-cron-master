<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDomain extends Model
{
    use HasFactory;

    protected $table = "category_domain";

    protected $connection = 'backend_mysql';
}
