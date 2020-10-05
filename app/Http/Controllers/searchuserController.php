<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class searchuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';
        if(Auth::user()){
            $categories = \App\Category::get();
            $product = \App\product::with('categories')->where("description", "LIKE", "%$keyword%")->paginate(6);
            $id_user = \Auth::user()->id;
            $count_data = $product->count();
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
            $data=['total_item'=> $total_item, 'keranjang'=>$keranjang, 'product'=>$product,'item'=>$item,'count_data'=>$count_data, 'categories'=>$categories];

            return view('customer.content_customer',$data);

        }
        else{

            $kategori = \App\Category::get();
            $product = \App\product::with('categories')->where("description", "LIKE", "%$keyword%")->paginate(6);
            /*$product = DB::table('products')
                        ->leftJoin('products', 'products.id', '=', 'category_product.product_id')
                        ->leftJoin('categories', 'categories.id', '=', 'category_product.category_id')
                        ->where('products.description',"LIKE"," $keyword")
                        ->paginate(6);*/
            $count_data = $product->count();
                
            return view('customer.content',['product'=> $product],['kategori'=>$kategori],['count_data'=>$count_data]);

        }

       
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
