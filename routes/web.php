<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerProductController;
use App\Http\Controllers\DaliveryServiceController;
use App\Http\Controllers\DeliveryReportController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductPromotionController;
use App\Http\Controllers\ProductTagController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\TestController;

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

Route::get('/', [GuestController::class, 'index']);
Route::get('register', [GuestController::class, 'showRegisterForm']);
Route::post('register', [GuestController::class, 'register']);
Route::get('login', [GuestController::class, 'showLoginForm']);
Route::post('login', [GuestController::class, 'login']);

Route::get('about', [GuestController::class, 'about']);
Route::get('contact', [GuestController::class, 'contact']);
Route::get('term_of_use', [GuestController::class, 'termOfUse']);
Route::get('privacy_policy', [GuestController::class, 'privacyPolicy']);
Route::get('delivery-report', [GuestController::class, 'deliveryReport'])->name('delivery.report.index');

Route::get('image/show/{image:slug}', [ImageController::class, 'show']);
Route::get('image/thumb/{image:slug}', [ImageController::class, 'showThumb']);
Route::get('image/small/{image:slug}', [ImageController::class, 'showSmall']);
Route::get('image/medium/{image:slug}', [ImageController::class, 'showMedium']);
Route::get('image/large/{image:slug}', [ImageController::class, 'showLarge']);

Route::get('test', [TestController::class, 'index']);

Route::group(['prefix' => 'customer', 'middleware' => 'customerAuth'], function () {
    Route::group(['middleware' => 'customerActiveAuth'], function () {
        Route::get('products', [ProductController::class, 'indexCustomerProduct']);
        Route::get('products/all', [ProductController::class, 'indexCustomerProductAll']);
        Route::post('products/search', [ProductController::class, 'searchCustomerProduct']);
        Route::get('products/promotions', [ProductController::class, 'indexCustomerPromotion']);
        Route::get('products/{product:slug}', [ProductController::class, 'showCustomerProduct']);

        Route::get('services', [ProductController::class, 'indexCustomerService']);

        Route::get('profile', [CustomerController::class, 'showProfile']);
        Route::put('profile', [CustomerController::class, 'updateProfile']);
        Route::get('document', [CustomerController::class, 'showDocument']);
        Route::put('document', [CustomerController::class, 'updateDocument']);
        Route::get('address', [CustomerController::class, 'showAddress']);
        Route::put('address', [CustomerController::class, 'updateAddress']);
        Route::get('password', [CustomerController::class, 'showPassword']);
        Route::put('password', [CustomerController::class, 'updatePassword']);
        Route::get('order', [OrderController::class, 'indexOrder']);
        Route::post('order', [OrderController::class, 'storeOrder']);
        Route::post('order/search', [OrderController::class, 'searchOrder']);
        Route::get('order/{order:slug}', [OrderController::class, 'showOrder']);
        Route::put('order/{order:slug}/slip', [OrderController::class, 'addSlipToOrder']);

        Route::get('cart', [CustomerProductController::class, 'index']);
        Route::post('cart', [CustomerProductController::class, 'store']);
        Route::put('cart/{product:slug}', [CustomerProductController::class, 'updateCartQuantity']);
        Route::delete('cart/{product:slug}', [CustomerProductController::class, 'destroy']);
        Route::get('cart/product/count', [CustomerProductController::class, 'productCount']);
    });
    Route::get('pending/{customer:slug}/edit', [GuestController::class, 'registerEdit']);
    Route::put('pending/{customer:slug}', [GuestController::class, 'registerUpdate']);
    Route::get('pending/{customer:slug}', [GuestController::class, 'registerPending']);
    Route::get('password/{customer:slug}/reset', [GuestController::class, 'passwordEdit']);
    Route::put('password/{customer:slug}/reset', [GuestController::class, 'passwordUpdate']);
    Route::get('logout', [GuestController::class, 'customerLogout']);
});


Route::group(['prefix' => 'admin', 'middleware' => 'adminAuth'], function () {
    Route::get('', [AdminController::class, 'dashboard']);
    Route::get('dashboard',  [AdminController::class, 'dashboard']);
    Route::get('super_admins', [AdminController::class, 'index']);
    Route::post('super_admins', [AdminController::class, 'store']);
    Route::get('super_admins/create', [AdminController::class, 'create']);
    Route::post('super_admins/search', [AdminController::class, 'search']);
    Route::get('super_admins/{super_admin:slug}/edit', [AdminController::class, 'edit']);
    Route::put('super_admins/{super_admin:slug}', [AdminController::class, 'update']);

    Route::get('products', [ProductController::class, 'index']);
    Route::post('products', [ProductController::class, 'store']);
    Route::get('products/create', [ProductController::class, 'create']);
    Route::post('products/search', [ProductController::class, 'search']);
    Route::get('products/{product:slug}/edit', [ProductController::class, 'edit']);
    Route::post('products/{product:slug}/status', [ProductController::class, 'changeStatus']);
    Route::put('products/{product:slug}', [ProductController::class, 'update']);
    Route::get('products/{product:slug}', [ProductController::class, 'show']);
    Route::delete('products/{product:slug}', [ProductController::class, 'destroy']);
    Route::post('product/promotion', [ProductController::class, 'addPromotion']);
    Route::post('product/category', [ProductController::class, 'addCategory']);
    Route::post('product/tag', [ProductController::class, 'addTag']);

    Route::get('categories', [CategoryController::class, 'index']);
    Route::post('categories', [CategoryController::class, 'store']);
    Route::get('categories/create', [CategoryController::class, 'create']);
    Route::post('categories/search', [CategoryController::class, 'search']);
    Route::get('categories/{category:slug}/edit', [CategoryController::class, 'edit']);
    Route::put('categories/{category:slug}', [CategoryController::class, 'update']);
    Route::get('categories/{category:slug}', [CategoryController::class, 'show']);
    Route::delete('categories/{category:slug}', [CategoryController::class, 'destroy']);

    Route::post('categories/{category_slug}/products', [CategoryProductController::class, 'store']);
    Route::delete('categories/{category_slug}/products/{product_slug}', [CategoryProductController::class, 'destroy']);

    Route::get('promotions', [PromotionController::class, 'index']);
    Route::post('promotions', [PromotionController::class, 'store']);
    Route::get('promotions/create', [PromotionController::class, 'create']);
    Route::post('promotions/search', [PromotionController::class, 'search']);
    Route::get('promotions/{promotion:slug}/edit', [PromotionController::class, 'edit']);
    Route::put('promotions/{promotion:slug}', [PromotionController::class, 'update']);
    Route::get('promotions/{promotion:slug}', [PromotionController::class, 'show']);
    Route::delete('promotions/{promotion:slug}', [PromotionController::class, 'destroy']);

    Route::post('promotions/{promotion_slug}/products', [ProductPromotionController::class, 'store']);
    Route::delete('promotions/{promotion_slug}/products/{product_slug}', [ProductPromotionController::class, 'destroy']);

    Route::get('tags', [TagController::class, 'index']);
    Route::post('tags', [TagController::class, 'store']);
    Route::get('tags/create', [TagController::class, 'create']);
    Route::post('tags/search', [TagController::class, 'search']);
    Route::get('tags/{tag:slug}/edit', [TagController::class, 'edit']);
    Route::put('tags/{tag:slug}', [TagController::class, 'update']);
    Route::get('tags/{tag:slug}', [TagController::class, 'show']);
    Route::delete('tags/{tag:slug}', [TagController::class, 'destroy']);

    Route::post('tags/{tag_slug}/products', [ProductTagController::class, 'store']);
    Route::delete('tags/{tag_slug}/products/{product_slug}', [ProductTagController::class, 'destroy']);

    Route::get('customers', [CustomerController::class, 'index']);
    Route::post('customers', [CustomerController::class, 'store']);
    Route::get('customers/create', [CustomerController::class, 'create']);
    Route::post('customers/search', [CustomerController::class, 'search']);
    Route::get('customers/{customer:slug}/edit', [CustomerController::class, 'edit']);
    Route::put('customers/{customer:slug}', [CustomerController::class, 'update']);
    Route::get('customers/{customer:slug}', [CustomerController::class, 'show']);
    Route::delete('customers/{customer:slug}', [CustomerController::class, 'destroy']);
    Route::put('customers/{customer:slug}/status', [CustomerController::class, 'updateStatus']);

    Route::get('orders', [OrderController::class, 'index']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::get('orders/create', [OrderController::class, 'create']);
    Route::post('orders/search', [OrderController::class, 'search']);
    Route::get('orders/{order:slug}/edit', [OrderController::class, 'edit']);
    Route::put('orders/{order:slug}', [OrderController::class, 'update']);
    Route::get('orders/{order:slug}', [OrderController::class, 'show']);
    Route::delete('orders/{order:slug}', [OrderController::class, 'destroy']);
    Route::put('orders/{order:slug}/status', [OrderController::class, 'updateStatus']);
    Route::put('orders/{order:slug}/shipment_price/{price}', [OrderController::class, 'updateShipmentPrice']);

    Route::delete('orderDetail/{product_id}/{order_id}/{order_slug}', [OrderDetailController::class, 'destroyProduct']);

    Route::get('deliveries', [DaliveryServiceController::class, 'index']);
    Route::post('deliveries', [DaliveryServiceController::class, 'store']);
    Route::get('deliveries/create', [DaliveryServiceController::class, 'create']);
    Route::post('deliveries/search', [DaliveryServiceController::class, 'search']);
    Route::get('deliveries/{delivery:slug}/edit', [DaliveryServiceController::class, 'edit']);
    Route::put('deliveries/{delivery:slug}', [DaliveryServiceController::class, 'update']);
    Route::get('deliveries/{delivery:slug}', [DaliveryServiceController::class, 'show']);
    Route::delete('deliveries/{delivery:slug}', [DaliveryServiceController::class, 'destroy']);

    Route::get('banks', [BankAccountController::class, 'index']);
    Route::post('banks', [BankAccountController::class, 'store']);
    Route::get('banks/create', [BankAccountController::class, 'create']);
    Route::post('banks/search', [BankAccountController::class, 'search']);
    Route::get('banks/{bank:slug}/edit', [BankAccountController::class, 'edit']);
    Route::put('banks/{bank:slug}', [BankAccountController::class, 'update']);
    Route::get('banks/{bank:slug}', [BankAccountController::class, 'show']);
    Route::delete('banks/{bank:slug}', [BankAccountController::class, 'destroy']);

    Route::get('delivery-reports', [DeliveryReportController::class, 'index'])->name('admin.delivery.report.index');
    Route::post('delivery-reports', [DeliveryReportController::class, 'store'])->name('admin.delivery.report.store');
    Route::get('delivery-reports/create', [DeliveryReportController::class, 'create'])->name('admin.delivery.report.create');
    Route::get('delivery-reports/{id}/edit', [DeliveryReportController::class, 'edit'])->name('admin.delivery.report.edit');
    Route::put('delivery-reports/{id}', [DeliveryReportController::class, 'update'])->name('admin.delivery.report.update');
    Route::delete('delivery-reports/{id}', [DeliveryReportController::class, 'destroy'])->name('admin.delivery.report.destroy');

    Route::get('logout', [GuestController::class, 'adminLogout']);
});

