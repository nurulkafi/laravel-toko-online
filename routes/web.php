<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController as ControllersProductController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
Route::get('',function(){
    return redirect('login');
});
// [1] Admin [2] Customer [3] Operator
Route::get('/home', function () {
    $userID = Auth::user()->id;
    $role = DB::table('model_has_roles')->where('model_id', $userID)->first();
    if($role->role_id != 2){
        return redirect('admin/dashboard');
    }else{
        return redirect('beranda');
    }
});
Route::get('beranda', [HomeController::class, 'index']);
Auth::routes();
Route::fallback(function () {
    $title = "404 Not Found";
    return view('admin.layouts.404', compact('title'));
});
Route::get('logout', function () {
    Auth::logout();
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
        Route::put('product/update/{id}', [ProductController::class, 'update']);
        Route::get('product/delete/{id}', [ProductController::class, 'destroy']);
        Route::get('product/images/edit/{id}', [ProductController::class, 'editImage']);
        Route::post('product/images/add/{id}', [ProductController::class, 'addImage']);
        Route::get('product/images/delete/{id}', [ProductController::class, 'destroyImage']);
        Route::get('product/atribute/edit/{id}',[ProductController::class, 'editAttribute']);
        Route::post('product/atribute/add', [ProductController::class, 'addAttribute']);
        Route::put('product/atribute/update/{id}', [ProductController::class, 'updateAtribute']);
        Route::get('product/atribute/delete/{id}', [ProductController::class, 'destroyAtribute']);
        //role
        Route::get('role',[RoleController::class,'index']);
        Route::get('role/add', [RoleController::class, 'create']);
        Route::post('role/add_data', [RoleController::class, 'store']);
        Route::get('role/edit/{id}',[RoleController::class,'edit']);
        Route::put('role/update_data/{id}',[RoleController::class,'update']);
        Route::get('role/delete/{id}',[RoleController::class,'destroy']);
        //user
        Route::get('users', [UsersController::class, 'index']);
        Route::get('users/add', [UsersController::class, 'create']);
        Route::post('users/add_data', [UsersController::class, 'store']);
        Route::get('users/edit/{id}',[UsersController::class,'edit']);
        Route::put('users/update/{id}', [UsersController::class, 'update']);
        Route::get('users/delete/{id}',[UsersController::class,'destroy']);
        //admin-orders
        Route::get('order',[AdminOrderController::class,'index'])->name('orders.index');
        Route::get('order/show/{id}', [AdminOrderController::class, 'show']);
        Route::get('order/process/{id}', [AdminOrderController::class, 'process']);
        Route::get('order/printinvoice/{id}',[AdminOrderController::class,'print']);
        Route::get('order/saveinvoice/{id}', [AdminOrderController::class, 'saveinvoice']);
        //shipment
        Route::get('order/shipment/{id}',[ShipmentController::class,'index']);
        Route::post('order/shipment/save/{id}', [ShipmentController::class, 'store']);
        //slider
        Route::get('slider',[SliderController::class,'index']);
        Route::get('slider/add',[SliderController::class,'create']);
        Route::post('slider/add_data', [SliderController::class, 'store']);

        Route::get('slider/delete/{id}', [SliderController::class, 'destroy']);
        //Report
        Route::get('report/revenue/{year}',[ReportController::class,'revenue']);
    });
});
//Product For User
Route::get('product', [ControllersProductController::class, 'index']);
Route::post('product/search',[ControllersProductController::class,'searchForm']);
Route::get('product/search/{id}', [ControllersProductController::class, 'resultSearch']);
Route::get('product/detail/{slug}',[ControllersProductController::class, 'show']);
Route::get('product/detail/search/{id}', [ControllersProductController::class, 'searchPriceAndQty']);
Route::get('product/category/{slug}',[ControllersProductController::class,'searchCategory1']);
Route::get('product/category/{slug}/{slug2}', [ControllersProductController::class, 'searchCategory2']);
//Cart
Route::get('cart',[CartController::class,'index']);
Route::group(['middleware' => ['auth']],function () {
Route::post('cart/add',[CartController::class,'store']);
Route::put('cart/update',[CartController::class,'update']);
Route::get('cart/remove/{id}',[CartController::class,'remove']);

});
//Api Raja Ongkir
Route::get('province/search/{id}', [ControllersProductController::class, 'searchCity']);
Route::get('cekongkir/{id}/berat/{berat}', [ControllersProductController::class, 'cekOngkir']);

//Register
Route::post('user/register',[CustomerController::class,'store']);

//checkout
Route::get('checkout',[OrderController::class,'index']);
Route::POST('docheckout', [OrderController::class, 'doCheckout']);
Route::get('order/confirm/{id}',[OrderController::class,'confirm']);

//notif midtrans
Route::POST('/payment/notification', [PaymentController::class, 'notification']);
Route::get('completed', [PaymentController::class, 'completed']);
Route::get('failed', [PaymentController::class, 'failed']);
Route::get('unfinish', [PaymentController::class, 'unfinish']);

//account
Route::get('order/info',[CustomerController::class,'orderinfo']);
