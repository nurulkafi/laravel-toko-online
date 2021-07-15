<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\UsersController;
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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('admin/dashboard',[DashboardController::class,'index']);

Auth::routes();
Route::fallback(function () {
    $title = "404 Not Found";
    return view('admin.layouts.404', compact('title'));
});

Route::group(['middleware' => ['auth']],function () {
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

        //product for user

    });
});
Route::get('product', [ControllersProductController::class, 'index']);
Route::get('product/detail/{slug}',[ControllersProductController::class, 'show']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
