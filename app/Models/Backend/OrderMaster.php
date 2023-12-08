<?php

namespace App\Models\Backend;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderMaster extends Model
{
    use HasFactory;
    use ModelHelper;

    const REFUND_STATUS_ID = 12;
    const REFUND_BY_AMAZON_ID = 201;
    const ORDER_FROM_HISTORIC_ID = 10;

    protected $connection = 'backend_mysql';
    protected $table = 'order_master';
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->fix_dilivery_date = self::parseOrDefaultTimeStamp($model,'fix_dilivery_date');
            $model->barcode_expiry = self::parseOrDefaultTimeStamp($model,'barcode_expiry');
            $model->billpay_due_date = self::parseOrDefaultTimeStamp($model,'billpay_due_date');
            $model->boleto_expiry_date = self::parseOrDefaultTimeStamp($model,'boleto_expiry_date');
            $model->date_of_birth = self::parseOrDefaultTimeStamp($model,'date_of_birth');
            $model->claim_status = 0;
            $model->special_offer_order = 0;
        });
    }

    protected $attributes = [
        "skype_id" => '',
        "del_alt_title" => '',
        "del_add3" => '',
        "del_best_time_call" => '',
        "del_dao_shopid" => '',
        "bill_add3" => '',
        "payment_gateway" => '',
        "payment_option_name" => '',
        "cookie_referral" => '',
        "sat_domain_id" => 0,
        "void_rem_amount" => 0.00,
        "bmi" => 0.00,
        "pending_uk" => 0,
        "bank_type" => '',
        "pay_point_msg" => '',
        "bank_details" => '',
        "barcode" => '',
        "barcode_url" => '',
        "cod_price" => 0,
        "cod_cost_price" => 0,
        "cod_currency_code" => '',
        "cash_payment_status" => 0,
        "drop_id" => 0,
        "drop_ordered_by" => 0,
        "klarna_reference" => '',
        "klarna_pno" => '',
        "klarna_invoice_no" => '',
        "klrana_invoice_fee" => 0,
        "klrana_invoice_fee_cost" => 0,
        "resp_code" => 0,
        "bck_del_phone" => '',
        "bck_del_mobile" => '',
        "klarna_file_name" => '',
        "billpay_invoice_fee" => 0,
        "billpay_invoice_fee_cost" => 0,
        "billpay_invoice_no" => '',
        "billpay_account_holder" => '',
        "billpay_account_number" => '',
        "billpay_bank_code" => '',
        "billpay_bank_name" => '',
        "brt_shipment_num" => '',
        "dni_no" => '',
        "browser" => '',
        "os" => '',
        "del_socolissimo_data" => '',
        "del_socolissimo_id" => '',
        "manufacure_claim_status" => 0,
        "delivery_claim_status" => 0,
        "boleto_url" => '',
        "boleto_reference" => '',
        "multibanko_entity" => '',
        "del_companyname" => 0,
        "klarna_order_id" => '',
        "order_score" => 0,
        "amazon_status" => 0,
        "om_order_deleted" => 0,
        "hasOfferTransactionId" => '',
        "customer_tax_id" => '',
        "wg_affliate_id" => 0,
        "tp_orderId" => '',
        "affliate_network_id" => 0,
    ];

    // * Relations 

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    public function orderProcessing()
    {
        return $this->hasOne(OrderProcessing::class, 'order_id', 'order_id');
    }

    public function orderPartialRefund()
    {
        return $this->hasOne(OrderPartialRefund::class, 'opr_order_id', 'order_id');
    }

    public function orderLog()
    {
        return $this->hasMany(OrderLog::class, 'order_id', 'id');
    }
}
