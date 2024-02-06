<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillInformation extends Model
{
    use HasFactory;

    public function setBillDateAttribute($value){
        $this->attributes['bill_date'] = date('Y-m-d',strtotime($value));
    }
}
