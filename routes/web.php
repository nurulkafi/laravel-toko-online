<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
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

Route::fallback(function(){
    $title = "404 Not Found";
    return view('admin.layouts.404',compact('title'));
});

Route::prefix('/admin')->group(function(){
    Route::get('dashboard',[DashboardController::class,'index']);
    //Route Kategori
    Route::get('categories',[CategoryController::class,'index']);
    Route::get('categories/add', [CategoryController::class, 'create']);
    Route::post('categories/add_data', [CategoryController::class, 'store']);
    Route::get('categories/edit/{id}', [CategoryController::class, 'edit']);
    Route::put('categories/update_data/{id}',[CategoryController::class,'update']);
    Route::get('categories/delete/{id}', [CategoryController::class, 'destroy']);
});
