<?php

namespace App\Models\Backend;

use App\Traits\ModelHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductsMaster extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $connection = 'backend_mysql';

    protected $table = 'products_master';

    // * helper methods

    public static function  getProductData($productMasterId)
    {
        return DB::connection('backend_mysql')
            ->table('products_master as pm')
            ->select(['pm.product_master_id', 'pm.pm_name as prod_master_name', 'pm.pm_name as product_name_english', 'pm.pm_ml_id', 'pm.pm_supplierid'])
            ->selectRaw("CASE pm.pm_type
                            WHEN 'single_product' THEN 'P'
                            WHEN 'product_package' THEN 'PP'
                            WHEN 'attributeproduct_package' THEN 'PP'
                            WHEN 'product_with_attribute' THEN 'PA'
                        END as type")
            ->join('stock as stk', 'stk.product_master_id', '=', 'pm.product_master_id')
            ->where('pm.product_master_id', $productMasterId)
            ->first();
    }

    public static function getCategoryIdFromDomainAndProductMasterId(int $domainId, int $productMasterId): int
    {
        return DB::connection('backend_mysql')
            ->table('products_master AS pm')
            ->join('product_master_category AS pmc', 'pm.product_master_id', '=', 'pmc.pmc_pm_id')
            ->join('category_domain AS cd', 'pmc.pmc_cm_id', '=', 'cd.cd_cm_id')
            ->select('cd.cd_id', 'cd.cd_name')
            ->where('cd.cd_domain_id', $domainId)
            ->where('pm.product_master_id', $productMasterId)
            ->value('cd.cd_id') ?? 0;
    }
}
