<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\product;
use App\order_product;
use App\Order;


class CustomerKeranjangController extends Controller
{
    
    public function index(Request $request)
    {   
        $session_id = $request->header('User-Agent');
        $categories = \App\Category::all();//paginate(10);
        $product = product::with('categories')->paginate(6);
        $count_data = $product->count();
        $keranjang = DB::select("SELECT orders.session_id, orders.status, orders.username, 
                    products.description, products.image, products.price, order_product.id,
                    order_product.order_id,order_product.product_id,order_product.quantity
                    FROM order_product, products, orders WHERE 
                    orders.id = order_product.order_id AND 
                    order_product.product_id = products.id AND orders.status = 'SUBMIT' 
                    AND orders.session_id = '$session_id' AND orders.username IS NULL ");
        $item = DB::table('orders')
                    ->where('session_id','=',"$session_id")
                    ->where('orders.status','=','SUBMIT')
                    ->whereNull('orders.username')
                    ->first();
        $item_name = DB::table('orders')
                    ->join('order_product','order_product.order_id','=','orders.id')
                    ->where('session_id','=',"$session_id")
                    ->whereNotNull('orders.username')
                    ->first();
        
        $total_item = DB::table('orders')
                    ->join('order_product','order_product.order_id','=','orders.id')
                    ->where('session_id','=',"$session_id")
                    ->whereNull('orders.username')
                    ->count();
        $data=['total_item'=> $total_item, 'keranjang'=>$keranjang, 'product'=>$product,'item'=>$item,'item_name'=>$item_name,'count_data'=>$count_data,'categories'=>$categories,];
       
        return view('customer.content_customer',$data);
    }
    
    public function simpan(Request $request){  
        $id = $request->header('User-Agent'); 
        $id_product = $request->get('Product_id');
        $quantity=$request->get('quantity');
        $price=$request->get('price');
        $cek_order = Order::where('session_id','=',"$id")
        ->where('status','=','SUBMIT')->whereNull('username')->first();
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
            $order->session_id = $id;
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

    public function min_order(Request $request){  
        $id = $request->header('User-Agent'); 
        $id_product = $request->get('Product_id');
        $quantity=$request->get('quantity');
        $price=$request->get('price');
        $cek_order = Order::where('session_id','=',"$id")
        ->where('status','=','SUBMIT')->whereNull('username')->first();
        if($cek_order !== null){
            $order_product = order_product::where('order_id','=',$cek_order->id)
            ->where('product_id','=',$id_product)->first();
            if(($order_product!== null) AND ($order_product->quantity > 1)){
                $order_product->quantity -= $quantity;
                $order_product->save();
                $cek_order->total_price -= $price * $quantity;
                $cek_order->save();
                return redirect()->back()->with('status','Product berhasil dikurang dari keranjang');
                }else if(($order_product !== null) and ($order_product->quantity <= 1)){
                        $delete = DB::table('order_product')->where('id', $order_product->id)->delete();
                        if($delete){
                            $cek_order_product = order_product::where('order_id','=',$cek_order->id)->count();
                            if($cek_order_product < 1){
                                $delete_order = DB::table('orders')->where('id', $cek_order->id)->delete();
                            }
                            else{
                                $cek_order->total_price -= $price * $quantity;
                                $cek_order->save();
                            }
                            return redirect()->back()->with('status','Product berhasil dihapus dari keranjang');
                        }
                        
                    }
        }
        return redirect()->back();
       
    }

    public function tambah(Request $request){
            
        $id = $request->get('id');
        $order_id = $request->get('order_id');
        $order_product = order_product::findOrFail($id);
        $order_product->quantity += 1;
        $order_product->save();
        if($order_product->save()){
                $order = Order::findOrFail($order_id);
                $order->total_price += $request->get('price');
                $order->save();
        }
           
            
        //$order->products()->attach($request->get('Product_id'));
        
        return redirect()->back()->with('status','Berhasil menambah produk');
    }

    public function kurang(Request $request){
            
        $id = $request->get('id');
        $order_id = $request->get('order_id');
        $order_product = order_product::findOrFail($id);

        if($order_product->quantity < 2){
            $delete = DB::table('order_product')->where('id', $id)->delete();   
            if($delete)
            {   
                $cek_order_product = order_product::where('order_id','=',$order_id)->first();
                if($cek_order_product == null){
                    DB::table('orders')->where('id', $order_id)->delete();
                }
                else{
                        $order = Order::findOrFail($order_id);
                        $order->total_price -= $request->get('price');
                        $order->save();
                    }
                return redirect()->back()->with('status','Berhasil menghapus produk dari keranjang');
            }
        }
        else{

            $order_product = order_product::findOrFail($id);
            $order_product->quantity -= 1;
            $order_product->save();
            if($order_product->save()){
                $order = Order::findOrFail($order_id);
                $order->total_price -= $request->get('price');
                $order->save();
                return redirect()->back()->with('status','Berhasil mengurangi produk');
            }
        } 
        
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
                        return redirect()->back()->with('status','Product berhasil dihapus dari keranjang');
    }

    public function pesan(Request $request){
        $id = $request->get('id');
        $username = $request->get('username');
        $email = $request->get('email');
        $address = $request->get('address');
        $phone = $request->get('phone');
        $orders = Order::findOrfail($id);
        $orders->username = $username;
        $orders->email = $email;
        $orders->address = $address;
        $orders->phone = $phone;
        $orders->save();
        $href='Hello..,  %0ANama %3A '.$username.'%0AEmail %3A '.$email.'%0ANo. Hp %3A' .$phone.'%0AAlamat %3A' .$address.',%0AIngin membeli %3A%0A';
        if($orders->save()){
            $pesan = DB::table('order_product')
                    ->join('orders','order_product.order_id','=','orders.id')
                    ->join('products','order_product.product_id','=','products.id')
                    ->where('orders.id','=',"$id")
                    ->get();
            foreach($pesan as $key=>$wa){
                $href.='*'.$wa->description.'%20(Qty %3A%20'.$wa->quantity.' Pcs)%0A';
            }
            $url = "https://wa.me/6282311988000‬?text=$href";
            return Redirect::to($url);
            
        }
        
    }

   
}
