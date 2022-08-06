<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\SliderController;
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

Route::get('login', [AccountController::class, 'login']);
Route::post('checkLogin', [AccountController::class, 'checkLogin']);

//thong qua middleware(checkLogin) de xac nhan nguoi dang nhap la admin thi duoc thuc hien cac chuc nang duoi
Route::prefix('admin')->name('admin')->middleware('checkLogin:admin')->group(function () {
    //route cho AcountController
    Route::get('users', [AccountController::class, 'users']);
    Route::get('displayAddUser', [AccountController::class, 'displayAddUser']);
    Route::post('addUser', [AccountController::class, 'addUser']);
    Route::get('resetPassword/{id}', [AccountController::class, 'resetPassword']);
    Route::get('view/{users_id}', [AccountController::class, 'view']);
    Route::get('delete/{users_id}', [AccountController::class, 'delete']);
    Route::get('update/{users_id}', [AccountController::class, 'update']);
    Route::post('updatePost/{users_id}', [AccountController::class, 'updatePost']);
    //route cho ProductController
    Route::get('product/index', [ProductController::class, 'index']);
    Route::get('product/create', [ProductController::class, 'create']);
    Route::post('product/createPost', [ProductController::class, 'createPost']);
    Route::get('product/update/{product_id}', [ProductController::class, 'update']);
    Route::get('product/view/{product_id}', [ProductController::class, 'view']);
    Route::post('product/updatePost/{product_id}', [ProductController::class, 'updatePost']);
    Route::get('product/delete/{product_id}', [ProductController::class, 'delete']);
    //route cho Category
    Route::get('category/index', [CategoryController::class, 'index']);
    Route::get('category/create', [CategoryController::class, 'create']);
    Route::post('category/createCategory', [CategoryController::class, 'createCategory']);
    Route::get('category/update/{category_id}', [CategoryController::class, 'update']);
    Route::get('category/view/{category_id}', [CategoryController::class, 'view']);
    Route::post('category/updatePost/{category_id}', [CategoryController::class, 'updatePost']);
    Route::get('category/delete/{category_id}', [CategoryController::class, 'delete']);
    //route cho order
    Route::get('order/index', [CartController::class, 'manage_order']);
    Route::get('order/view/{order_id}', [CartController::class, 'view']);
    Route::get('order/delete/{order_id}', [CartController::class, 'delete']);

    //route cho delivery
    Route::get('delivery', [DeliveryController::class, 'delivery']);
    Route::post('delivery', [DeliveryController::class, 'select_delivery']);
    Route::post('insert_delivery', [DeliveryController::class, 'insert_delivery']);
    Route::post('select_feeship', [DeliveryController::class, 'select_feeship']);
    
    //route cho banner
    Route::get('manager_slider', [SliderController::class, 'manager_slider']);
    Route::get('slider/create', [SliderController::class, 'create']);
    Route::post('slider/create_slider', [SliderController::class, 'create_slider']);
    Route::get('slider/delete/{silder_id}', [SliderController::class, 'delete']);
});

//route customers
Route::get('addCustomer', [AccountController::class, 'displayaddCustomer']);
Route::post('addCustomers', [AccountController::class, 'addCustomers']);

//route cho search
Route::get('/search_admin', [AccountController::class, 'search']);
Route::get('/user', [AccountController::class, 'searchPost']);
Route::get('/search_product', [ProductController::class, 'search']);
Route::get('/index', [ProductController::class, 'searchPost']);
Route::post('search_product', [HomeController::class, 'search']);

// kiemt tra email cua adduser
Route::get('/test', [AccountController::class, 'test']);
Route::get('/testEmail', [AccountController::class, 'testEmail']);
Route::get('/testCustomers', [AccountController::class, 'test1']);

//frontend
Route::get('single/index', [SingleController::class, 'index']);
Route::get('home/index', [HomeController::class, 'index']);

//the loai san pham
Route::get('show_category/{category_id}', [CategoryController::class, 'show_category']);

//details_product
Route::get('single/{product_id}', [ProductController::class, 'show_details']);

//route cart
Route::post('/show_cart', [CartController::class, 'order']);
Route::get('show_cart', [CartController::class, 'show_cart']);
Route::get('delete_cart/{rowId}', [CartController::class, 'delete_cart']);
Route::post('update_qty', [CartController::class, 'update_qty']);


//checkout
Route::get('checkout', [CartController::class, 'checkout']);
Route::post('/save_checkout', [CartController::class, 'save_checkout']);
Route::get('logout', [CartController::class, 'logout_checkout']);

//payment
Route::get('payment', [CartController::class, 'payment']);
Route::post('payment_order', [CartController::class, 'payment_order']);

//Mail
Route::get('send_mail', [MailController::class, 'send_mail']);

//login facebook
Route::get('login_facebook', [AccountController::class, 'login_facebook']);
Route::get('login/callback', [AccountController::class, 'callback_facebook']);

//contact
Route::get('contact', [HomeController::class, 'contact']);