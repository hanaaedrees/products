<?php

use App\Http\Controllers\CategoryConroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VisitorController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/', [VisitorController ::class, 'index'])->name('VPage');

Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');


    Route::get('/category', [CategoryConroller::class, 'show'])->name('cat.show');

    Route::post('/category/store', [CategoryConroller::class, 'store'])->name('cat.store');

    Route::get('/category/{id}', [CategoryConroller::class, 'delete'])->name('cat.delete');

    Route::post('/category/update', [CategoryConroller::class, 'update'])->name('cat.update');

    //products

    Route::get('/product/show', [ProductController::class, 'index'])->name('product.index');

    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');

    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');

    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    
    Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');   

    Route::get('/product/show/{id}', [ProductController::class, 'show_details'])->name('product_deatails');


    //orders router

    Route::post('/order/store', [HomeController::class, 'orderStore'])->name('order.store');   

    Route::get('/order/show', [HomeController::class, 'show_order'])->name('order.show');

  
    Route::post('/order/{id}/status', [HomeController::class, 'changeStatus'])->name('order.status');

    
require __DIR__.'/auth.php';
