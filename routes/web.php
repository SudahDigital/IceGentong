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
Route::get('/product/detail/', 'ProductDetailController@detail')->name('product_detail');
Route::get('/cara-belanja', function(){
        $categories = \App\Category::get();	
    	return view('customer.carabelanja',['categories'=>$categories]);
        })->name('cara_belanja');
Route::get('/contact', function(){
        $categories = \App\Category::get();	
        return view('customer.contact',['categories'=>$categories]);
        })->name('contact');
Route::get('/home_customer', 'CustomerKeranjangController@index');
Route::post('/keranjang/simpan','CustomerKeranjangController@simpan')->name('customer.keranjang.simpan');
Route::post('/keranjang/tambah','CustomerKeranjangController@tambah')->name('customer.keranjang.tambah');
Route::post('/keranjang/kurang','CustomerKeranjangController@kurang')->name('customer.keranjang.kurang');
Route::post('/keranjang/delete','CustomerKeranjangController@delete')->name('customer.keranjang.delete');
Route::post('/keranjang/pesan','CustomerKeranjangController@pesan')->name('customer.keranjang.pesan');
Route::get('/histori','historiController@index')->name('riwayat_pemesanan');
Route::resource('category','filterProductController');
Route::resource('search','searchController');

Route::match(["GET", "POST"], "/register", function(){
    return redirect("/login");
})->name("register");

Route::get('/admin', function () {
    $categories = \App\Category::get();
    return view('auth.login',['categories'=>$categories]);
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


    

