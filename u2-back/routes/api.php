<?php

use App\Http\Controllers\api\OrdersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/get-orders', [OrdersController::class, 'getOrders']);
Route::get('/get-orders-by-date', [OrdersController::class, 'getOrdersByDate']);
Route::group(['middleware' => ['auth:sanctum']], function () {
});