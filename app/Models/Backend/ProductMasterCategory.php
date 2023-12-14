<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMasterCategory extends Model
{
    use HasFactory;

    protected $connection = 'backend_mysql';
    protected $table = 'product_master_category';


    // * Relations

    public function productMaster()
    {
        return $this->belongsTo(ProductsMaster::class, 'pmc_pm_id', 'product_master_id');
    }


    public function categoryDomain()
    {
        return $this->belongsTo(CategoryDomain::class, 'pmc_cm_id', 'cd_cm_id');
    }
}
