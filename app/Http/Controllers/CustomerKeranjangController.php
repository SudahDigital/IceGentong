<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerKeranjangController extends Controller
{
    
    public function index()
    {
        
        $id_user = \Auth::user()->id;
        $keranjang = \App\Order::with('product')
                    ->where('user_id','=',"$id_user")
                    ->get();
        $total_item = \App\Order::with('product')
                    ->where('user_id','=',"$id_user")
                    ->count();
        $data=['total_item'=> $total_item];          
        return view('customer.content',$data);
    }
    
    public function simpan(Request $request)
    {   
        $quantity=$request->get('quantity');
        $price=$request->get('price');
        $order = new \App\Order;
        $order->user_id = $request->get('user_id');
        $order->quantity = $quantity;
        $order->invoice_number = date('YmdHis');
        $order->total_price = $price * $quantity;
        $order->status = 'SUBMIT';
        $order->save();
        $order->products()->attach($request->get('Product_id'));
        return redirect()->route('customer.keranjang')->back()->with('status','Product Berhasil Dimasukan Kekeranjang');
    }
}
