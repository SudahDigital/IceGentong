<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\order_product;
use App\Order;

class CustomerKeranjangController extends Controller
{
    
    public function index()
    {
        $product = \App\product::with('categories')->paginate(6);
        $id_user = \Auth::user()->id;
        $keranjang = \App\Order::with('products')
                    ->where('user_id','=',"$id_user")
                    ->get();
        $total_item = \App\Order::with('products')
                    ->where('user_id','=',"$id_user")
                    ->count();
        $data=['total_item'=> $total_item, 'keranjang'=>$keranjang, 'product'=>$product];          
        return view('customer.content_customer',$data);
    }
    
    public function simpan(Request $request)
    {   
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
                $cek_order->total_price = $price * $order_product->quantity;
                $cek_order->save();
                }else{
                        $new_order_product = new order_product;
                        $new_order_product->order_id =  $cek_order->id;
                        $new_order_product->product_id = $id_product;
                        $new_order_product->quantity = $quantity;
                        $new_order_product->save();
                        $cek_order->total_price += $price * $new_order_product->quantity;
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
        
        return redirect()->route('customer.keranjang')->with('status','Product Berhasil Dimasukan Kekeranjang');
    }
}
