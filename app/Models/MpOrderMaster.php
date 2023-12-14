<?php

namespace App\Models;

use App\Models\Backend\OrderRef;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class MpOrderMaster extends Model
{
    public $timestamps = false;

    protected $table = 'mp_order_masters';

    const DATE_OF_BIRTH = "1988-01-01";

    const EMAIL_ARRAY = [
        '168' => 'yJOX8I+6W6O9xa6NWWjpLoBhYpYU55RLWaNiR06ncRQ=',
        '169' => '045MyohqINNDFu1YGjqgFIItH+D0WHXj48PdppYVPY4=',
        '170' => 'eSCNqXZ4qTRExkDEsd5ylYb84KchGNVJ8G6XntPeZ4I=',
        '179' => 'JMpT1QGTBw9zTWyE6NPxNaZpiWpJ3JJz5kjBWXMleD4=',
        '202' => '/IeEMrxrdG177dyY1S3wW9LZRl9najCRKbOJhK8+s4Q=',
        '240' => 'XSXeILjf4kVrQvVu2T0NsWWyIo4DfVX2OYLlPILggM4=',
        '241' => 'Q0Y2Rwv+J3b09m3oqRLkEuBm0VU49bFhEh6U19PeyPY=',
        '242' => 'rCtAJBzcFGRUrK21kOVOb0d0oyWWwk0ww54oQISbciU=',
        '243' => 'qNB7dhNbz1duqA2USIm3UsOuTqbjLhtlHQ/YFam5wEQ=',
        '253' => 'PS+9PlBYuGMcIhRvA+gALr783oTmG3T/dzZxqsuWKf0=',
        '254' => 'FnQUZQzBxqlLXAeuFH7anYneUcJenL7Unq3qbqm8cck=',
        '255' => 'h/bfXOG+fKMDoHN+UZCM3tW8FrOAcwEDDwzhEIsXq2U='
    ];

    protected $fillable = [
        'order_id',
        'order_date',
        'master_order_id',
        'parent_order_id',
        'void_order_id',
        'current_status',
        'domain_id',
        'payment_gateway_master_id',
        'tracking_number',
        'courier_id',
        'transaction_id',
        'currency_id_customer',
        'csr_id',
        'cust_id',
        'del_country_id',
        'bill_country_id',
        'source',
        'shipping_site_id',
        'shipping_master_id',
        'source_site_id',
        'paneu_vat_cm_id',
        'del_master_country_id',
        'ebay_order_id',
        'order_master_details',
        'vat_details',
        'refunds_details',
        'address_details',
    ];

    protected $casts = [
        'order_master_details' => 'json',
        'vat_details' => 'json',
        'refunds_details' => 'json',
        'address_details' => 'json',
    ];

    // * Relations 

    public function orderDetails(): HasMany
    {
        return $this->hasMany(
            related: MpOrderDetail::class,
            foreignKey: 'order_id',
            localKey: 'order_id'
        );
    }

    public function orderProcessing(): HasMany
    {
        return $this->hasMany(
            related: MpOrderProcessing::class,
            foreignKey: 'order_id',
            localKey: 'order_id'
        );
    }

    // * helper methods

    public static function generateNewOrderNo(): string
    {
        $domainPrefix = '44';

        $orderRef = OrderRef::create([
            'ref_id' => OrderRef::count() + 1,
        ]);

        return $domainPrefix . $orderRef->ref_id;
    }
}
