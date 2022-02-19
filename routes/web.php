<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\ClientMainController;
use App\Http\Controllers\ClientMenuController;
use App\Http\Controllers\ClientProductController;
use App\Http\Controllers\CartController;

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

Route::get('admin/user/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/user/login/store', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {
        #Login
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);

        #Menu
        Route::prefix('menu')->group(function () {
            Route::get('create', [MenuController::class, 'create'])->name('admin.menu.create');
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{id}', [MenuController::class, 'update']);
            Route::get('delete/{id}', [MenuController::class, 'delete']);
        });
        #Product
        Route::prefix('product')->group(function () {
            Route::get('create',[ProductController::class,'create']);
            Route::post('create',[ProductController::class,'store']);
            Route::get('list',[ProductController::class,'index']);
            Route::get('edit/{product}',[ProductController::class,'show'])->name('admin.product.edit');
            Route::post('edit/{product}',[ProductController::class,'update'])->name('admin.product.update');
            Route::get('delete/{product}',[ProductController::class,'destroy']);
        });

        #Slider
        Route::prefix('slider')->group(function (){
            Route::get('add',[SliderController::class,'add']);
            Route::post('add',[SliderController::class,'store']);
            Route::get('list',[SliderController::class,'index'])->name('admin.slider.list');
            Route::get('edit/{slider}',[SliderController::class,'show']);
            Route::post('edit/{slider}',[SliderController::class,'update']);
            Route::get('delete/{slider}',[SliderController::class,'delete']);
        });

    });
});
Route::get('/',[ClientMainController::class,'index']);
Route::get('detail/cat/{id}',[ClientMenuController::class,'index'])->name('detail.cat');
Route::get('detail/product/{id}',[ClientProductController::class,'index'])->name('detail.product');

//------------------------------------------Cart------------------------------
Route::post('add/cart',[CartController::class,'index'])->name('add.cart');
Route::get('list/cart',[CartController::class,'show'])->name('list.cart');
Route::post('update/cart',[CartController::class,'update']);
Route::get('delete/cart/{id}',[CartController::class,'delete'])->name('delete.cart');
Route::post('order/products',[CartController::class,'orderProduct'])->name('order.product');
