<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController as ControllersProductController;
use Illuminate\Auth\Middleware\Authenticate;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return redirect('admin/dashboard');
});
// Route::get('admin/dashboard',[DashboardController::class,'index']);

Auth::routes();
Route::fallback(function () {
    $title = "404 Not Found";
    return view('admin.layouts.404', compact('title'));
});
Route::get('logout', function () {
    \Auth::logout();
    return redirect('login');
});

Route::group(['middleware' => ['role:Admin|Operator']],function () {
    Route::prefix('/admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index']);
        //Route Kategori
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('categories/add', [CategoryController::class, 'create']);
        Route::post('categories/add_data', [CategoryController::class, 'store']);
        Route::get('categories/edit/{id}', [CategoryController::class, 'edit']);
        Route::put('categories/update_data/{id}', [CategoryController::class, 'update']);
        Route::get('categories/delete/{id}', [CategoryController::class, 'destroy']);
        //Route Produk
        Route::get('product', [ProductController::class, 'index']);
        Route::get('product/add', [ProductController::class, 'create']);
        Route::post('product/add_data', [ProductController::class, 'store']);
        Route::get('product/edit/{id}', [ProductController::class, 'edit']);
        Route::put('product/update_data/{id}', [ProductController::class, 'update']);
        Route::get('product/delete/{id}', [ProductController::class, 'destroy']);
        //Product variant
        Route::get('product_variant/edit/{id}', [ProductController::class, 'edit_pvariant']);
        Route::put('product_variant/update', [ProductController::class, 'update_pvariant']);
        Route::get('test', [TestController::class, 'index']);
        Route::post('save', [TestController::class, 'save']);

        //role
        Route::get('role',[RoleController::class,'index']);
        Route::get('role/add', [RoleController::class, 'create']);
        Route::post('role/add_data', [RoleController::class, 'store']);
        Route::get('role/edit/{id}',[RoleController::class,'edit']);
        Route::put('role/update_data/{id}',[RoleController::class,'update']);

        //user
        Route::get('users', [UsersController::class, 'index']);
        Route::get('users/add', [UsersController::class, 'create']);
        Route::post('users/add_data', [UsersController::class, 'store']);

        //admin-orders
        Route::get('order',[AdminOrderController::class,'index'])->name('orders.index');
        Route::get('order/show/{id}', [AdminOrderController::class, 'show']);
        Route::get('order/process/{id}', [AdminOrderController::class, 'process']);

        Route::get('order/shipment/{id}',[ShipmentController::class,'index']);
        Route::post('order/shipment/save/{id}', [ShipmentController::class, 'store']);
        });
});
//Product For User
Route::get('product', [ControllersProductController::class, 'index']);
Route::post('product/search',[ControllersProductController::class,'searchForm']);
Route::get('product/search/{id}', [ControllersProductController::class, 'resultSearch']);
Route::get('product/detail/{slug}',[ControllersProductController::class, 'show']);
Route::get('product/detail/search/{id}', [ControllersProductController::class, 'searchPriceAndQty']);

//Cart
Route::get('cart',[CartController::class,'index']);
Route::group(['middleware' => ['auth']],function () {
    Route::post('cart/add',[CartController::class,'store']);
    Route::get('checkout',[OrderController::class,'index']);
});
//Api Raja Ongkir
Route::get('province/search/{id}', [ControllersProductController::class, 'searchCity']);
Route::get('cekongkir/{id}/berat/{berat}/kurir/{kurir}', [ControllersProductController::class, 'cekOngkir']);

//Register
Route::post('user/register',[CustomerController::class,'store']);
// Route::get('register',[RegisterController::class,'index']);
// Route::group(['middleware' => ['role:customer']],function () {

Route::POST('coba', [OrderController::class, 'doCheckout']);
Route::get('order/confirm/{id}',[OrderController::class,'confirm']);
// });

Route::POST('/payment/notification', [PaymentController::class, 'notification']);
Route::get('completed', [PaymentController::class, 'completed']);
Route::get('failed', [PaymentController::class, 'failed']);
Route::get('unfinish', [PaymentController::class, 'unfinish']);


