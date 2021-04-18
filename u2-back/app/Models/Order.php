<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $guards=[];

    //se agrega accesor para parsear fecha
    public function getDeliveryAtAttribute($value)
    {
        return  Carbon::parse($value)->format('Y-m-d');
    }
}
