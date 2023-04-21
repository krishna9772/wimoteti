<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\GoldController;
use App\Http\Controllers\Dashboard\PosController;
use App\Http\Controllers\Dashboard\ExchangeReturnController;
use App\Http\Controllers\Dashboard\ReportController;






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


Route::get('login', [AdminController::class, 'loginPage'])->name('login.page');
Route::post('login', [AdminController::class, 'login'])->name('login');
Route::get('logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('homepage')->middleware('auth');


Route::group(['namespace' => "Auth", 'prefix' => 'auth/', 'middleware' => 'auth'], function () {


    // User start //
    Route::get('/users', [UserController::class, 'index'])->name('user');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}/delete', [UserController::class, 'delete'])->name('user.delete');
    // User end //

    // Customer start //
    Route::get('/customers', [CustomerController::class, 'index'])->name('customer');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customers/{id}/update', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customers/{id}/delete', [CustomerController::class, 'delete'])->name('customer.delete');
    Route::post('/customers/add', [CustomerController::class, 'add'])->name('customer.add');
    // Customer end //

     // Category start //
     Route::get('/category', [CategoryController::class, 'index'])->name('category');
     Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
     Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
     Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
     Route::put('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
     Route::delete('/category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
     // Category end //

     // Setting start //
     Route::get('/setting', [SettingController::class, 'index'])->name('setting');
     Route::get('/setting/create', [SettingController::class, 'create'])->name('setting.create');
     Route::post('/setting/store', [SettingController::class, 'store'])->name('setting.store');
     Route::get('/setting/{id}/edit', [SettingController::class, 'edit'])->name('setting.edit');
     Route::put('/setting/{id}/update', [SettingController::class, 'update'])->name('setting.update');
     Route::delete('/setting/{id}/delete', [SettingController::class, 'delete'])->name('setting.delete');
     // Setting end //

     // Product start //
     Route::get('/product', [ProductController::class, 'index'])->name('product');
     Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
     Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
     Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
     Route::get('/product/{id}/detail', [ProductController::class, 'detail'])->name('product.detail');
     Route::put('/product/{id}/update', [ProductController::class, 'update'])->name('product.update');
     Route::delete('/product/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');
     // Product end //

     // Gold start //
     Route::get('/gold', [GoldController::class, 'index'])->name('gold');
     Route::get('/gold/create', [GoldController::class, 'create'])->name('gold.create');
     Route::post('/gold/store', [GoldController::class, 'store'])->name('gold.store');
     Route::get('/gold/{id}/edit', [GoldController::class, 'edit'])->name('gold.edit');
     Route::put('/gold/{id}/update', [GoldController::class, 'update'])->name('gold.update');
     Route::delete('/gold/{id}/delete', [GoldController::class, 'delete'])->name('gold.delete');
     // Gold end //

     // Pos start //
     Route::get('/pos', [PosController::class, 'index'])->name('pos');
     Route::get('/pos/create', [PosController::class, 'create'])->name('pos.create');
     Route::post('/pos/store', [PosController::class, 'store'])->name('pos.store');
     Route::get('/pos/{id}/edit', [PosController::class, 'edit'])->name('pos.edit');
     Route::put('/pos/{id}/update', [PosController::class, 'update'])->name('pos.update');
     Route::delete('/pos/{id}/delete', [PosController::class, 'delete'])->name('pos.delete');
     Route::get('/pos/{id}/get-customer', [PosController::class, 'getCustomer'])->name('get-customer');
     Route::get('/pos/get-created-customer', [PosController::class, 'getcreatedCustomer'])->name('get-created-customer');
     Route::get('/pos/{id}/get-product', [PosController::class, 'getProduct'])->name('get-product');
     Route::get('/pos/{id}/voucher', [PosController::class, 'voucher'])->name('pos.voucher');
     Route::post('/pos/voucher', [PosController::class, 'voucherSearch'])->name('pos.voucher.search');
     Route::get('/voucher/blank', [PosController::class, 'voucherBlank'])->name('voucher.blank');
     // Pos end //

    //Return and Exchange Start //
     Route::get('/exchange-return', [ExchangeReturnController::class, 'index'])->name('exchange-return');
     Route::get('/exchange-return/create', [ExchangeReturnController::class, 'create'])->name('exchange-return.create');
     Route::post('/exchange-return/store', [ExchangeReturnController::class, 'store'])->name('exchange-return.store');
     Route::get('/exchange-return/{id}/edit', [ExchangeReturnController::class, 'edit'])->name('exchange-return.edit');
     Route::put('/exchange-return/{id}/update', [ExchangeReturnController::class, 'update'])->name('exchange-return.update');
     Route::delete('/exchange-return/{id}/delete', [ExchangeReturnController::class, 'delete'])->name('exchange-return.delete');
     Route::get('/exchange-return/{id}/get-pos', [ExchangeReturnController::class, 'getPos'])->name('get-pos');
      //Return and Exchange End //

    //Report Start //
     Route::get('/report', [ReportController::class, 'index'])->name('report');
     Route::post('/report-filter', [ReportController::class, 'filter'])->name('report.filter');
    //Report End //
     Route::get('/backup',[HomeController::class,'handle'])->name('backup-database');
});