<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTrucks extends Model
{
    use HasFactory;

    public function getdailyTrucksDateAttribute($value){
        return getDateFormate($value);
    }
    public function gettruckNoAttribute($value){
        return strtoupper($value);
    }
}
