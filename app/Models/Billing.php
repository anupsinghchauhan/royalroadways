<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    protected $table = "billings";
    protected $fillable = [
        'royal_email',
        'lrno',
        'truckno',
        'royal_date',
        'royal_from',
        'royal_to',
        'driver_details',
        'consignor1',
        'consignee1',
        'consignor_add_1',
        'consignor_add_2',
        'consignee_add_1',
        'consignee_add_2',
        'gstin1',
        'gstin2',
        'no1',
        'nogstc1',
        'weight1',
        'rate1',
        'total_freighty_to_opay1',
        'royal_amount',
        'transport',
        'cdst',
        'sgst',
        'total_amount',
        'consignor',
        'consignee',
        'ToPayOrPaid',
        'pdf_file',
        'pdf_name',
        'UnpaidParty',
        'site_master_id',
    ]; 

    public function getRoyalDateAttribute($value)
    {
       return date('d M Y',strtotime($value));
    }
}
