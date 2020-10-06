<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\order_product;
use App\Order;

class ProductDetailController extends Controller
{
    public function detail(Request $request){
        $categories = \App\Category::get();//paginate(10);
        $kategori = $categories;
        $product = product::with('categories')->where('id','=',$request->id)->first();
        /*$count_data = $product->count();
        $keranjang = DB::select("SELECT orders.user_id, orders.status, 
                    products.description, products.image, products.price, order_product.id,
                    order_product.order_id,order_product.product_id,order_product.quantity
                    FROM users, order_product, products, orders WHERE 
                    orders.id = order_product.order_id AND orders.user_id = users.id AND 
                    order_product.product_id = products.id AND orders.status = 'SUBMIT' 
                    AND users.id = ' $id_user'");
        $item = DB::table('orders')
                    ->join('order_product','order_product.order_id','=','orders.id')
                    ->join('users','users.id','=','orders.user_id')
                    ->where('user_id','=',"$id_user")
                    ->where('orders.status','=','SUBMIT')
                    ->first();
        
        $total_item = DB::table('orders')
                    ->join('order_product','order_product.order_id','=','orders.id')
                    ->join('users','users.id','=','orders.user_id')
                    ->where('user_id','=',"$id_user")
                    ->count();*/
        $data=['product'=>$product,'categories'=>$categories,'kategori'=>$kategori];
       
        return view('customer.detail',$data);
    }
}
