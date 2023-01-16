<?php

use App\Http\Controllers\Product\IndexController;
use Illuminate\Support\Facades\Route;

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
})->name('home');
Route::group(['namespace' => 'App\Http\Controllers\Product'], function () {
    Route::get('/products', 'IndexController')->name('products.index');
    Route::get('/products/create', 'CreateController')->name('products.create');
    Route::post('/products', 'StoreController')->name('products.store');
    Route::get('/products/{product}', 'ShowController')->name('products.show');
    Route::get('/products/{product}/edit', 'EditController')->name('products.edit');
    Route::patch('/products/{product}', 'UpdateController')->name('products.update');
    Route::delete('/products/{product}', 'DestroyController')->name('products.destroy');
});
Route::group(['namespace' => 'App\Http\Controllers\Comment'], function () {
    Route::post('/comments', 'StoreController')->name('comments.store');
    Route::delete('/comments/{comment}', 'DestroyController')->name('comments.destroy');
});
Route::group(['namespace' => 'App\Http\Controllers\Category'], function () {
    Route::get('/categories', 'IndexController')->name('categories.index');
    Route::get('/categories/create', 'CreateController')->name('categories.create');
    Route::post('/categories', 'StoreController')->name('categories.store');
    Route::get('/categories/{category}', 'ShowController')->name('categories.show');
    Route::get('/categories/{category}/edit', 'EditController')->name('categories.edit');
    Route::patch('/categories/{category}', 'UpdateController')->name('categories.update');
    Route::delete('/categories/{category}', 'DestroyController')->name('categories.destroy');
});



