<?php

namespace App\Models\Backend;

use App\Traits\ModelHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $connection = 'backend_mysql';
    protected $table = "order_details";

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->send_reminder_date = self::parseOrDefaultTimeStamp($model, 'send_reminder_date');
            $model->send_reminder_followup_date = self::parseOrDefaultTimeStamp($model, 'send_reminder_followup_date');
            $model->expiry_reminder_date = self::parseOrDefaultTimeStamp($model, 'expiry_reminder_date');
            $model->newsletter_send_reminder_date = self::parseOrDefaultTimeStamp($model, 'newsletter_send_reminder_date');
            $model->send_reminder_my_smile_date = self::parseOrDefaultTimeStamp($model, 'send_reminder_my_smile_date');
            $model->send_reminder_my_smile_followup_date = self::parseOrDefaultTimeStamp($model, 'send_reminder_my_smile_followup_date');
            $model->send_reminder_8_pads_abs_date = self::parseOrDefaultTimeStamp($model, 'send_reminder_8_pads_abs_date');
            $model->send_reminder_8_pads_abs_followup_date = self::parseOrDefaultTimeStamp($model, 'send_reminder_8_pads_abs_followup_date');
            $model->send_reminder_supplement_date = self::parseOrDefaultTimeStamp($model, 'send_reminder_supplement_date');
            $model->send_reminder_weight_loss_supplement_date = self::parseOrDefaultTimeStamp($model, 'send_reminder_weight_loss_supplement_date');
            $model->prod_returned_date = self::parseOrDefaultTimeStamp($model, 'prod_returned_date');

            $model->vat_per = $model->vat_per ? floatval($model->vat_per) : 0.0;
            $model->prod_ship = $model->prod_ship ? floatval($model->prod_ship) : 0.0;
            $model->returned_by =  0;
            $model->prod_refund_qty = 0;
            $model->prod_refund_vat = 0;
            $model->prod_return_qty = 0;
            $model->other_vat_charge = 0;
            $model->prod_refund_amount = 0;
            $model->prod_return_reuse_cp = 0;
            $model->prod_return_reuse_qty = 0;
            $model->prod_refund_amazon_vat = 0;
            $model->prod_refund_shipping_vat = 0;
            $model->prod_refund_amazon_vat_lc = 0;
            $model->product_pack = 0;
        });
    }

    protected $attributes = [
        'product_pack' => '',
        'site_product_pack' => '',
        'multibuy_id' => 0,
        'multibuy_qty' => 0,
        'prod_promo_code' => '',
        'prod_image' => '',
        'ho_payout' => 0.00,
        'ho_payout_percentage' => 0.00
    ];

    // * Relations 

    public function OrderMaster()
    {
        return $this->belongsTo(OrderMaster::class, 'order_id');
    }
}
