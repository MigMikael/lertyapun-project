<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
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

Route::get('image/show/{image:slug}', [ImageController::class, 'show']);
Route::get('image/thumbnail/{image:slug}', [ImageController::class, 'showThumbnail']);

Route::group(['prefix' => 'admin'], function () {
    Route::get('', function () { return redirect('admin/dashboard'); });


    Route::get('dashboard',  [AdminController::class, 'dashboard']);


    Route::get('products', [ProductController::class, 'index']);
    Route::post('products', [ProductController::class, 'store']);
    Route::get('products/create', [ProductController::class, 'create']);
    Route::get('products/{product:slug}/edit', [ProductController::class, 'edit']);
    Route::put('products/{product:slug}', [ProductController::class, 'update']);
    Route::get('products/{product:slug}', [ProductController::class, 'show']);
    Route::delete('products/{product:slug}', [ProductController::class, 'destroy']);


    Route::get('categories', [CategoryController::class, 'index']);
    Route::post('categories', [CategoryController::class, 'store']);
    Route::get('categories/create', [CategoryController::class, 'create']);
    Route::get('categories/{category:slug}/edit', [CategoryController::class, 'edit']);
    Route::put('categories/{category:slug}', [CategoryController::class, 'update']);
    Route::get('categories/{category:slug}', [CategoryController::class, 'show']);
    Route::delete('categories/{category:slug}', [CategoryController::class, 'destroy']);


    Route::get('tags', [TagController::class, 'index']);
    Route::post('tags', [TagController::class, 'store']);
    Route::get('tags/create', [TagController::class, 'create']);
    Route::get('tags/{tag:slug}/edit', [TagController::class, 'edit']);
    Route::put('tags/{tag:slug}', [TagController::class, 'update']);
    Route::get('tags/{tag:slug}', [TagController::class, 'show']);
    Route::delete('tags/{tag:slug}', [TagController::class, 'destroy']);


    Route::get('customers', [CustomerController::class, 'index']);
    Route::post('customers', [CustomerController::class, 'store']);
    Route::get('customers/create', [CustomerController::class, 'create']);
    Route::get('customers/{customer:slug}/edit', [CustomerController::class, 'edit']);
    Route::put('customers/{customer:slug}', [CustomerController::class, 'update']);
    Route::get('customers/{customer:slug}', [CustomerController::class, 'show']);
    Route::delete('customers/{customer:slug}', [CustomerController::class, 'destroy']);


    Route::get('orders', [OrderController::class, 'index']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::get('orders/create', [OrderController::class, 'create']);
    Route::get('orders/{order:slug}/edit', [OrderController::class, 'edit']);
    Route::put('orders/{order:slug}', [OrderController::class, 'update']);
    Route::get('orders/{order:slug}', [OrderController::class, 'show']);
    Route::delete('orders/{order:slug}', [OrderController::class, 'destroy']);
});
