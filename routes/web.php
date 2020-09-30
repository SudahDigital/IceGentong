<?php

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


Auth::routes();
Route::get('/', 'WelcomeController@index');
Route::get('/customer/product/detail/', 'CustomerProductController@detail')->name('product_detail');
Route::get('/cara-belanja', 'CustomerCaraBelanjaController@index')->name('cara_belanja');
Route::get('/contact', 'CustomerContactController@index')->name('contact');

Route::get('/admin', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['auth','checkRole:ADMIN']],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('users','UserController');
    Route::get('/categories/trash', 'CategoryController@trash')->name('categories.trash');
    Route::get('/categories/{id}/restore', 'CategoryController@restore')->name('categories.restore');
    Route::delete('/categories/{category}/delete-permanent','CategoryController@deletePermanent')->name('categories.delete-permanent');
    Route::resource('categories','CategoryController');
    Route::get('/ajax/categories/search', 'CategoryController@ajaxSearch');
    Route::get('/products/trash', 'productController@trash')->name('products.trash');
    Route::get('/products/{id}/restore', 'productController@restore')->name('products.restore');
    Route::delete('/products/{products}/delete-permanent','productController@deletePermanent')->name('products.delete-permanent');
    Route::resource('products', 'productController');
    Route::resource('orders', 'OrderController');
});

Route::group(['middleware' => ['auth','checkRole:CUSTOMER']],function(){
    Route::post('/keranjang/simpan','CustomerKeranjangController@simpan')->name('customer.keranjang.simpan');
    Route::get('/keranjang','CustomerKeranjangController@index')->name('customer.keranjang');
});