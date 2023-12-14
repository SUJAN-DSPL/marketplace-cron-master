<?php

declare(strict_types=1);

namespace App\Enums\CronJob;

enum AmazonOrderStatusEnum: int
{
    case DELETED = 0;

    case CAPTURED = 1;

    case CAPTURED_OTHER = 2;

    case ARCHIVE = 3;

    case DECLINED = 4;
    case PENDING_DISPATCH = 5;

    case DISPATCH_OUT_OF_STOCK = 6;

    case PENDING_ORDERS = 7;

    case ORDERED = 8;

    case PENDING_OUT_OF_STOCK = 9;

    case HISTORIC = 10;

    case REFUNDS = 11;

    case ARCHIVE_REFUNDS = 12;

    case CHARGEBACK = 13;

    case CHARGEBACK_WON = 14;

    case CHARGEBACK_LOST = 15;

    case SPLIT = 16;

    case RESEND = 17;

    case HISTORIC_REFUND = 18;

    case HISTORIC_REFUND_RESEND = 19;

    case RESOLVED = 20;

    case PRE_AUTHORIZE = 21;

    case WAITING_BANK_TRANS = 22;

    case CASH_ON_DELIVERY = 23;

    case KLARNA_PRE_AUTHORIZE = 24;

    case TEST = 25;

    case PRE_AUTH_COD = 26;

    case AWAITING_CHEQUE_CLEARANCE = 27;

    case BILL_PAY_PRE_AUTHORIZE = 28;

    case HISTORIC_RESOLVED = 29;

    case CODE_AWAITING_BANK_TRANS = 30;

    case CIC_PRE_AUTHORIZE = 31;

    case AWAITING_PENDING_DISPATCH = 32;

    case SUSPENDED = 33;

    case APPROVED_REFUND = 34;

    case AWAITING_CIC_PRE_AUTHORIZE = 35;

    case OTHER_ORDERS = 36;

    case PENDING_COD = 37;

    case PENDING_BANK_TRANSFER = 38;

    case BT_DIRECT_DEBIT = 39;

    case BT_DIRECT_DEBIT_APPROVED = 40;

    case MANUFACTURE_CLAIMS_PENDING = 41;

    case MANUFACTURE_CLAIMS_RE_CREDIT = 42;

    case MANUFACTURE_CLAIMS_RESOLVED = 43;

    case DELIVERY_CLAIMS_PENDING = 44;

    case DELIVERY_CLAIMS_RE_CREDIT = 45;

    case DELIVERY_CLAIMS_RESOLVED = 46;

    case NEW_RESEND = 47;

    case DOCTOR = 48;

    case TRUSTLY_BANK_TRANSFER = 49;

    case SUPPLIER_AWAITING_PENDING_DISPATCH = 50;

    case NEW_FREE = 51;

    case VOID = 52;

    case VOID_REFUND = 53;

    case PENDING_PAID = 54;

    case UNRESOLVED_HISTORIC = 55;

    case OUT_OF_STOCK_COD = 56;

    case OUT_OF_STOCK_ARCHIVED = 57;

    case RETURNED_LOST_CHARGE_BACK = 58;

    case OTHER_CHARGE_BACK = 59;

    case DELIVERY_PROBLEMS = 60;

    case MARKET_PLACE_PENDING_VERIFICATION = 61;

    case PENDING_DISPATCH_SFP = 62;

    case PENDING_DISPATCH_DHL = 63;

    case PENDING_DISPATCH_AMZ_MCF = 64;

    case MISPLACED_COD_ORDERS = 65;

    case AWAITING_SENT_AMZ_MCF = 66;

    case PENDING_HISTORIC = 67;

    /*public static function status_arr(): array
    {
        return [
            '0' => 'Deleted',
            '1' => 'New COD',
            '2' => 'New Bank Transfer',
            '3' => 'Archived',
            '4' => 'Cancelled',
            '5' => 'Paid',
            '6' => 'Out of Stock',
            '7' => 'Pending Orders',
            '8' => 'Ordered',
            '9' => 'Pending out of stock',
            '10' => 'Historic',
            '11' => 'Pending Refunds',
            '12' => 'Archive Refund',
            '13' => 'Pending Chargeback',
            '14' => 'Won Chargeback',
            '15' => 'Lost Chargeback',
            '16' => 'Splitted',
            '17' => 'Resend',
            '19' => 'Returned',
            '20' => 'Resolved',
            '21' => 'Pre Authorize',
            '22' => 'Waiting Bank Transfer',
            '23' => 'Pending Cash Delivery',
            '24' => 'Klarna Pre Authorize',
            '25' => 'Test',
            '26' => 'Confirmed COD',
            '27' => 'Awaiting Cheque Clearence',
            '28' => 'Billpay Pre Authorize',
            '29' => 'Returned',
            '30' => 'COD Awaiting Bank Transfers',
            '31' => 'CIC Pre Authorize',
            '32' => 'Pending Dispatch',
            '33' => 'Suspended',
            '34' => 'Approved Refund',
            '35' => 'Awaiting CIC Pre Authorize',
            '36' => 'Other Payment',
            '37' => 'Pending COD',
            '38' => 'Pending Bank Transfer',
            '39' => 'New Direct Debit',
            '40' => 'Approved Direct Debit',
            '41' => 'Manufacture Claims Pending',
            '42' => 'Manufacture Claims Re-credit',
            '43' => 'Manufacture Claims Resolved',
            '44' => 'Delivery Claims Pending',
            '45' => 'Delivery Claims Re-credit',
            '46' => 'Delivery Claims Resolved',
            '47' => 'New Resend',
            '48' => 'Doctor',
            '49' => 'Trustly - Bank Transfer',
            '50' => 'Supplier Awaiting Dispatch',
            '51' => 'Free Order',
            '52' => 'Void',
            '53' => 'Void Refund',
            '54' => 'Pending Paid',
            '55' => 'Unresolved historic',
            '56' => 'Out of Stock (COD)',
            '57' => 'Out of Stock (Archived)',
            '58' => 'Returned Lost Chargeback',
            '59' => 'Other Chargeback',
            '60' => 'Delivery Problems',
            '61' => 'Marketplace Pending Verification',
            '62' => 'Pending Dispatch SFP',
            '63' => 'Pending Dispatch DHL',
            '64' => 'Pending Dispatch Amazon MCF',
            '65' => 'Misplaced COD',
            '66' => 'Awating Sent Amazon MCF',
            '67' => 'Pending Historic',
        ];
    }*/
}
