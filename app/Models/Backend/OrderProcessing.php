<?php

namespace App\Models\Backend;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProcessing extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $connection = 'backend_mysql';

    protected $table = 'order_processing';

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->paid_date = self::parseOrDefaultTimeStamp($model,'paid_date');
            $model->refund_date = self::parseOrDefaultTimeStamp($model,'refund_date');
            $model->archive_refund_date = self::parseOrDefaultTimeStamp($model,'archive_refund_date');
            $model->outof_sotck_date = self::parseOrDefaultTimeStamp($model,'outof_sotck_date');
            $model->reminder_email_3_month_mail_sent_date = self::parseOrDefaultTimeStamp($model,'reminder_email_3_month_mail_sent_date');
            $model->unused_comfort_point_reminder_sent_date = self::parseOrDefaultTimeStamp($model,'unused_comfort_point_reminder_sent_date');
            $model->comfort_points_expiring_in_45days_reminder_sent_date = self::parseOrDefaultTimeStamp($model,'comfort_points_expiring_in_45days_reminder_sent_date');
            $model->comfort_points_expiring_in_20days_reminder_sent_date = self::parseOrDefaultTimeStamp($model,'comfort_points_expiring_in_20days_reminder_sent_date');
            $model->comfort_points_expiring_in_10days_reminder_sent_date = self::parseOrDefaultTimeStamp($model,'comfort_points_expiring_in_10days_reminder_sent_date');
            $model->comfort_points_expiring_in_5days_reminder_sent_date = self::parseOrDefaultTimeStamp($model,'comfort_points_expiring_in_5days_reminder_sent_date');
            $model->comfort_points_expiring_in_3days_reminder_sent_date = self::parseOrDefaultTimeStamp($model,'comfort_points_expiring_in_3days_reminder_sent_date');
            $model->pre_auth_date = self::parseOrDefaultTimeStamp($model,'pre_auth_date');
            $model->archive_date = self::parseOrDefaultTimeStamp($model,'archive_date');
            $model->decline_date = self::parseOrDefaultTimeStamp($model,'decline_date');
            $model->chargeback_date = self::parseOrDefaultTimeStamp($model,'chargeback_date');
            $model->lost_chargeback_date = self::parseOrDefaultTimeStamp($model,'lost_chargeback_date');
            $model->won_chargeback_date = self::parseOrDefaultTimeStamp($model,'won_chargeback_date');
            $model->approve_refund_date = self::parseOrDefaultTimeStamp($model,'approve_refund_date');
            $model->unresolved_historic_date = self::parseOrDefaultTimeStamp($model,'unresolved_historic_date');
            $model->resend_date = self::parseOrDefaultTimeStamp($model,'resend_date');
            $model->deleted_date = self::parseOrDefaultTimeStamp($model,'deleted_date');
            $model->reminder_date = self::parseOrDefaultTimeStamp($model,'reminder_date');
            $model->returned_date = self::parseOrDefaultTimeStamp($model,'returned_date');
            $model->void_date = self::parseOrDefaultTimeStamp($model,'void_date');
            $model->suspended_date = self::parseOrDefaultTimeStamp($model,'suspended_date');
            $model->delivery_problem_date = self::parseOrDefaultTimeStamp($model,'delivery_problem_date');
            $model->archive_email_sent_date = self::parseOrDefaultTimeStamp($model,'archive_email_sent_date');
            $model->out_of_stock_expected_date = self::parseOrDefaultTimeStamp($model,'out_of_stock_expected_date');
            $model->decline_date_supp = self::parseOrDefaultTimeStamp($model,'decline_date_supp');
            $model->dispatched_date_supp = self::parseOrDefaultTimeStamp($model,'dispatched_date_supp');
            $model->waiting_bank_date = self::parseOrDefaultTimeStamp($model,'waiting_bank_date');
            $model->test_date = self::parseOrDefaultTimeStamp($model,'test_date');
            $model->cod_preauth_date = self::parseOrDefaultTimeStamp($model,'cod_preauth_date');
            $model->chq_date_recevied = self::parseOrDefaultTimeStamp($model,'chq_date_recevied');
            $model->chq_date_bank = self::parseOrDefaultTimeStamp($model,'chq_date_bank');
            $model->special_offer_order_date = self::parseOrDefaultTimeStamp($model,'special_offer_order_date');
            $model->email_sentfor_bt_date = self::parseOrDefaultTimeStamp($model,'email_sentfor_bt_date');
            $model->pending_cod_date = self::parseOrDefaultTimeStamp($model,'pending_cod_date');
            $model->pending_bank_date = self::parseOrDefaultTimeStamp($model,'pending_bank_date');
            $model->dispatch_outof_sotck_date = self::parseOrDefaultTimeStamp($model,'dispatch_outof_sotck_date');
            $model->manufacure_claim_date = self::parseOrDefaultTimeStamp($model,'manufacure_claim_date');
            $model->manufacure_claim_recredit_date = self::parseOrDefaultTimeStamp($model,'manufacure_claim_recredit_date');
            $model->manufacure_claim_resolve_date = self::parseOrDefaultTimeStamp($model,'manufacure_claim_resolve_date');
            $model->delivery_claim_date = self::parseOrDefaultTimeStamp($model,'delivery_claim_date');
            $model->delivery_claim_recredit_date = self::parseOrDefaultTimeStamp($model,'delivery_claim_recredit_date');
            $model->delivery_claim_resolve_date = self::parseOrDefaultTimeStamp($model,'delivery_claim_resolve_date');
            $model->doctor_send_date = self::parseOrDefaultTimeStamp($model,'doctor_send_date');
            $model->doctor_process_date = self::parseOrDefaultTimeStamp($model,'doctor_process_date');
            $model->prescription_generated_date = self::parseOrDefaultTimeStamp($model,'prescription_generated_date');
            $model->outofstock_cod_date = self::parseOrDefaultTimeStamp($model,'outofstock_cod_date');
            $model->outofstock_archived_date = self::parseOrDefaultTimeStamp($model,'outofstock_archived_date');

            $model->archive_by = 0;
            $model->decline_by = 0;
            $model->archive_from = 0;
            $model->decline_from = 0;
            $model->archive_reason_id = 0;
            $model->resend_by = 0;
            $model->deleted_by = 0;
            $model->reminded_by = 0;
            $model->returned_by = 0;
            $model->chargeback_by = 0;
            $model->chargeback_from = 0;
            $model->chargeback_amount = 0;
            $model->won_chargeback_by = 0;
            $model->lost_chargeback_by = 0;
            $model->void_by = 0;
            $model->void_from = 0;
            $model->weight_kg = 0;
            $model->amazon_comm = 0;
            $model->postage_fee = 0;
            $model->suspended_by = 0;
            $model->resources_fee = 0;
            $model->amazon_ppc_fee = 0;
            $model->suspended_from = 0;
            $model->amount_received = "N";
            $model->amount_remitted = "N";
            $model->fulfillment_fee = 0;
            $model->removal_charges = 0;
            $model->claim_invoice_no = 0;
            $model->approve_refund_by = 0;
            $model->delivery_problem_by = 0;
            $model->delivery_problem_from = 0;
            $model->unresolved_historic_by = 0;
            $model->refund_amount_requested = 0;
            $model->unresolved_historic_from = 0;
            $model->delivery_problem_reason_id = 0;
            $model->delivery_problem_resolved_by = 0;
        });
    }

    protected $attributes = [
        'refund_reason' => '',
        'refund_exchange_rate' => 0,
        'refund_gateway' => 0,
        'outof_sotck_by' => 0,
        'decline_by_supp' => 0,
        'decline_from_supp' => 0,
        'decline_reason_supp' => '',
        'dispatch_by_supp' => 0,
        'op_promotional_offer' => '',
        'op_promotional_value' => 0,
        'op_no_of_package' => 0,
        'waiting_bank_by' => 0,
        'pec_token' => '',
        'test_by' => 0,
        'cod_preauth_by' => 0,
        'chq_currency' => '',
        'chq_amount' => 0,
        'chq_no' => 0,
        'pending_cod_by' => 0,
        'pending_cod_from' => 0,
        'pending_cod_reason' => '',
        'pending_cod_reason_id' => 0,
        'pending_bank_by' => 0,
        'pending_bank_from' => 0,
        'pending_bank_reason' => '',
        'pending_bank_reason_id' => 0,
        'dispatch_outof_sotck_date_by' => 0,
        'dispatch_outof_sotck_from' => 0,
        'manufacure_claim_by' => 0,
        'manufacure_claim_recredit_by' => 0,
        'manufacure_claim_resolved_by' => 0,
        'delivery_claim_by' => 0,
        'delivery_claim_recredit_by' => 0,
        'delivery_claim_resolved_by' => 0,
        'doctor_id' => 0,
        'doctor_by' => '',
        'doctor_suspend_reason' => '',
        'doctor_ip' => '',
        'doctor_sign' => '',
        'doctor_stamp' => '',
        'doctor_disp_ins' => '',
        'doctor_notes' => '',
        'doctor_suspend_reason_id' => 0,
        'prescription_filename' => '',
        'doctor_fees' => 0,
        'outofstock_cod_by' => 0,
        'outofstock_cod_from' => 0,
        'outofstock_cod_reason_id' => 0,
        'outofstock_archived_by' => 0,
        'outofstock_archived_from' => 0,
        'outofstock_archived_reason_id' => 0
    ];
}
