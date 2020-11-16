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
        //return response()->json(['return' => 'some data']);    
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
            
        $id = $request->get('id_detil');
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
            
        $id = $request->get('id_detil');
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

    public function ajax_cart(Request $request)
    {   
        $session_id = $request->header('User-Agent');
        $total_item = DB::table('orders')
                    ->join('order_product','order_product.order_id','=','orders.id')
                    ->where('session_id','=',"$session_id")
                    ->whereNull('orders.username')
                    ->count();
        if ($total_item < 1){
            echo '<div id="accordion">
                    <div class="card fixed-bottom" style="">
                        <div id="card-cart" class="card-header" >
                            <table width="100%" style="margin-bottom: 40px;">
                                <tbody>
                                    <tr>
                                        <td width="5%" valign="middle">
                                            <div id="ex4">
                                        
                                                <span class="p1 fa-stack fa-2x has-badge" data-count="0">
                                            
                                                    <!--<i class="p2 fa fa-circle fa-stack-2x"></i>-->
                                                    <i class="p3 fa fa-shopping-cart " data-count="4b" style=""></i>
                                                </span>
                                            </div> 
                                        </td>
                                        <td width="25%" align="left" valign="middle">
                                            <h5 id="total_kr_">Rp.0</h5>
                                        </td>
                                        <td width="5%" valign="middle" >
                                        <a id="cv" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4" class="collapsed">
                                                <i class="fas fa-chevron-up" style=""></i>
                                            </a>
                                        </td>
                                        <td width="33%" align="right" valign="middle">
                                        
                                        <h5>(0 Item)</h5>
                                        
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div  class="collapse" data-parent="#accordion" style="" >
                            <div class="card-body" id="card-detail">
                                <div class="col-md-12">
                                
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        else
        {
        $session_id = $request->header('User-Agent');
        $keranjang = \App\Order::with('products')
                    ->where('status','=','SUBMIT')
                    ->where('session_id','=',"$session_id")
                    ->whereNull('username')->get();
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
        $item_price = $item->total_price;
        echo 
        '<div id="accordion">
            <div class="card fixed-bottom" style="">
                <div id="card-cart" class="card-header" >
                    <table width="100%" style="margin-bottom: 40px;">
                        <tbody>
                            <tr>
                                <td width="5%" valign="middle">
                                    <div id="ex4">
                                
                                        <span id="" class="p1 fa-stack fa-2x has-badge" data-count="'.$total_item.'">
                                    
                                            <!--<i class="p2 fa fa-circle fa-stack-2x"></i>-->
                                            <i class="p3 fa fa-shopping-cart " data-count="4b" style=""></i>
                                        </span>
                                    </div> 
                                </td>
                                <td width="25%" align="left" valign="middle">
                                    <h5 id="total_kr_">Rp.&nbsp;'.number_format(($item_price) , 0, ',', '.').'</h5>
                                    <input type="hidden" id="total_kr_val" value="'.$item_price.'">
                                </td>
                                <td width="5%" valign="middle" >
                                <a id="cv" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4" class="collapsed">
                                        <i class="fas fa-chevron-up" style=""></i>
                                    </a>
                                </td>
                                <td width="33%" align="right" valign="middle">
                                
                                <h5>('.$total_item.'&nbsp;Item)</h5>
                                
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="collapse-4" class="collapse" data-parent="#accordion" style="" >
                    <div class="card-body" id="card-detail">
                        <div class="col-md-12">
                            <table width="100%" style="margin-bottom: 40px;">
                                <tbody>';
                                    foreach($keranjang as $order){
                                        foreach($order->products as $detil){
                                        echo'<tr>
                                            <td width="25%" valign="middle">
                                                <img src="'.asset('storage/'.$detil->image).'" 
                                                class="image-detail"  alt="...">   
                                            </td>
                                            <td width="60%" align="left" valign="top">
                                                <p class="name-detail">'.$detil->description.'</p>';
                                                $total=$detil->price * $detil->pivot->quantity;
                                                echo'<h1 id="productPrice_kr'.$detil->id.'" style="color:#6a3137; !important; font-family: Open Sans;">Rp.&nbsp;'.number_format($total, 0, ',', '.').'</h1>
                                                <table width="10%">
                                                    <tbody>
                                                        <tr id="response-id'.$detil->id.'">
                                                            
                                                            <td width="10px" align="left" valign="middle">
                                                            <input type="hidden" id="order_id'.$detil->id.'" name="order_id" value="'.$order->id.'">
                                                            <input type="hidden" id="harga_kr'.$detil->id.'" name="price" value="'.$detil->price.'">
                                                            <input type="hidden" id="id_detil'.$detil->id.'" value="'.$detil->pivot->id.'">
                                                            <input type="hidden" id="jmlkr_'.$detil->id.'" name="quantity" value="'.$detil->pivot->quantity.'">    
                                                            <button class="button_minus" onclick="button_minus_kr('.$detil->id.')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                                
                                                            </td>
                                                            <td width="10px" align="middle" valign="middle">
                                                                <p id="show_kr_'.$detil->id.'" class="d-inline" style="">'.$detil->pivot->quantity.'</p>
                                                            </td>
                                                            <td width="10px" align="right" valign="middle">
                                                                <button class="button_plus" onclick="button_plus_kr('.$detil->id.')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                            </td>
                                                        
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td width="15%" align="right" valign="top" style="padding-top: 5%;">
                                                <button class="btn btn-default" onclick="delete_kr('.$detil->id.')" style="">X</button>
                                                <input type="hidden"  id="order_id_delete'.$detil->id.'" name="order_id" value="'.$order->id.'">
                                                <input type="hidden"  id="quantity_delete'.$detil->id.'" name="quantity" value="'.$detil->pivot->quantity.'">
                                                <input type="hidden"  id="price_delete'.$detil->id.'" name="price" value="'.$detil->price.'">
                                                <input type="hidden"  id="product_id_delete'.$detil->id.'"name="product_id" value="'.$detil->id.'">
                                                <input type="hidden" id="id_delete'.$detil->id.'" name="id" value="'.$detil->pivot->id.'">
                                            </td>
                                        </tr>';
                                        
                                        }
                                    }
                                    echo '<tr>
                                        <td align="right" colspan="3">';
                                                if($total_item > 0){
                                                echo '<a type="button" class="btn button_add_to_cart" data-toggle="modal" data-target="#my_modal_ajax">Beli Sekarang</a>';
                                                }
                                        echo'</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="my_modal_ajax" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content" style="background: #FDD8AF">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                    </div>
                    <form method="POST" target="_BLANK" action="'.route('customer.keranjang.pesan').'">
                    <input type="hidden" name="_token" value="'.csrf_token();echo'">
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-sm-12">
                                
                                    <div class="card mx-auto contact_card" style="border-radius:15px;">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="text" value="';if($item_name !== null){echo $item_name->username;}else{echo '';} echo'" name="username" class="form-control contact_input" placeholder="Name" id="name" required autocomplete="off" autofocus>
                                                
                                            </div>
                                            <hr style="border-top:1px solid rgba(116, 116, 116, 0.507);">
                                            <div class="form-group">
                                                <input type="email" value="';if($item_name !== null){echo $item_name->email;}else{echo '';} echo'" name="email" class="form-control contact_input" placeholder="Email" id="email" required autocomplete="off" >
                                            </div>
                                            <hr style="border-top:1px solid rgba(116, 116, 116, 0.507);">
                                            <div class="form-group">
                                                <textarea type="text"  name="address" class="form-control contact_input" placeholder="Address" id="address" required autocomplete="off" ">';if($item_name !== null){echo $item_name->address;}else{echo '';} echo'</textarea>
                                            </div>
                                            <hr style="border-top:1px solid rgba(116, 116, 116, 0.507);">
                                            <div class="form-group">
                                                <input type="number" value="';if($item_name !== null){echo $item_name->phone;}else{echo '';} echo'" name="phone" class="form-control contact_input" placeholder="Phone" id="phone" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mx-auto text-center">
                                        
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <input type="hidden" id="order_id_pesan" name="id" value="';if($item !== null){echo $item->id;}else{echo '';} echo'"/>
                        <button type="submit" class="btn button_add_to_cart" onclick="pesan_wa()"  style="background-color: #4AC959;"><i class="fab fa-whatsapp" style="font-weight: bold;"></i>Pesan</button>
                    </div>
                    </form>
                </div>
                
                </div>
            </div>
        </div>';
        }
    }

}
