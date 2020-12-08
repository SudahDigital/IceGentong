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
Route::get('/home_cart', 'CustomerKeranjangController@ajax_cart');
Route::post('/keranjang/simpan','CustomerKeranjangController@simpan')->name('customer.keranjang.simpan');
Route::post('/keranjang/min_order','CustomerKeranjangController@min_order')->name('customer.keranjang.min_order');
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

//Admin
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/change_password', 'changePasswordController@index')->name('changepass');
Route::post('/users/post/change_password', 'changePasswordController@changepassword')->name('post.changepass');
Route::resource('users','UserController');
Route::get('/banner/trash', 'BannerController@trash')->name('banner.trash');
Route::get('/banner/{id}/restore', 'BannerController@restore')->name('banner.restore');
Route::delete('/banner/{banner}/delete-permanent','BannerController@deletePermanent')->name('banner.delete-permanent');
Route::resource('banner','BannerController');
Route::get('/categories/trash', 'CategoryController@trash')->name('categories.trash');
Route::get('/categories/{id}/restore', 'CategoryController@restore')->name('categories.restore');
Route::delete('/categories/{category}/delete-permanent','CategoryController@deletePermanent')->name('categories.delete-permanent');
Route::resource('categories','CategoryController');
Route::get('/ajax/categories/search', 'CategoryController@ajaxSearch');
Route::get('/products/trash', 'productController@trash')->name('products.trash');
Route::get('/products/{id}/restore', 'productController@restore')->name('products.restore');
Route::delete('/products/{products}/delete-permanent','productController@deletePermanent')->name('products.delete-permanent');
Route::resource('products', 'productController');
Route::get('orders/export_mapping', 'OrderController@export_mapping')->name('orders.export_mapping') ;
Route::get('/orders/{id}/edit_order', 'OrderEditController@edit')->name('order_edit');
Route::post('/orders/edit_order_update', 'OrderEditController@update')->name('order_edit_update');
Route::get('/orders/{id}/detail', 'OrderController@detail')->name('orders.detail');
Route::resource('orders', 'OrderController');



    

