<?php

namespace App\Http\Controllers\api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\DateRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
   public function getOrders()
   {
       $orders=Order::orderBy('delivery_at')->get();
      return response()->json($orders);
   }

   public function getOrdersByDate(DateRequest $request)
   {
       $orders=Order::whereDate('delivery_at',$request->date)->get();
      return response()->json($orders);
   }
}
