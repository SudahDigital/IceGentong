<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\product;
use App\order_product;
use App\Order;


class CustomerKeranjangController extends Controller
{
    
    public function index(Request $request)
    {
        $categories = \App\Category::get();//paginate(10);
        $product = product::with('categories')->paginate(6);
        $count_data = $product->count();
        $id_user = \Auth::user()->id;
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
                    ->count();
        $data=['total_item'=> $total_item, 'keranjang'=>$keranjang, 'product'=>$product,'item'=>$item,'count_data'=>$count_data,'categories'=>$categories];
       
        return view('customer.content_customer',$data);
    }
    
    public function simpan(Request $request){   
        $id_product = $request->get('Product_id');
        $quantity=$request->get('quantity');
        $price=$request->get('price');
        $cek_order = Order::where('user_id','=',$request->get('user_id'))
        ->where('status','=','SUBMIT')->first();
        if($cek_order !== null){
            $order_product = order_product::where('order_id','=',$cek_order->id)
            ->where('product_id','=',$id_product)->first();
            if($order_product!== null){
                $order_product->quantity += $quantity;
                $order_product->save();
                $cek_order->total_price += $price * $quantity;
                $cek_order->save();
                }else{
                        $new_order_product = new order_product;
                        $new_order_product->order_id =  $cek_order->id;
                        $new_order_product->product_id = $id_product;
                        $new_order_product->quantity = $quantity;
                        $new_order_product->save();
                        $cek_order->total_price += $price * $quantity;
                        $cek_order->save();
                }
        }
        else{

            $order = new \App\Order;
            $order->user_id = $request->get('user_id');
            //$order->quantity = $quantity;
            $order->invoice_number = date('YmdHis');
            $order->total_price = $price * $quantity;
            $order->status = 'SUBMIT';
            $order->save();
            if($order->save()){
                $order_product = new \App\order_product;
                $order_product->order_id = $order->id;
                $order_product->product_id = $request->get('Product_id');
                $order_product->quantity = $request->get('quantity');
                $order_product->save();
            }

        }
            
        //$order->products()->attach($request->get('Product_id'));
        
        return redirect()->back()->with('status','Product berhasil dimasukan kekeranjang');
    }

    public function delete(Request $request){

        $id = $request->get('id');
        $product_id = $request->get('product_id');
        $order_id = $request->get('order_id');
        $quantity = $request->get('quantity');
        $price = $request->get('price');
        $order_product = order_product::where('order_id','=',$order_id)->count();
                        if($order_product <= 1){
                        $delete = DB::table('order_product')->where('id', $id)->delete();   
                        if($delete){
                            DB::table('orders')->where('id', $order_id)->delete();
                            }
                        }
                        else{
                             $delete2 = DB::table('order_product')->where('id', $id)->delete();
                             if($delete2){
                                $orders = Order::findOrFail($order_id);
                                $total_price = $price * $quantity;
                                $orders->total_price -= $total_price;
                                $orders->save();
                             }
                        }
                        return redirect()->back()->with('status','Product berhasil dihapus kekeranjang');
    }

   
}
