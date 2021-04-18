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

    public function products()
    {
       return $this->hasMany(order_product::class)
                    ->join('products as pd','orders_products.product_id','pd.id')
                    ->join('providers as pv','pd.provider_id','pv.id')
                    ->select('orders_products.*','pd.*','pv.name as provider');
    }
}
