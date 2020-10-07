<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\product;
use App\order_product;
use App\Order;

class WelcomeController extends Controller
{
    public function index()
    {   
        if(\Auth::user()){
           return redirect('/home_customer');
        }
        else{
            $kategori = \App\Category::get();
            $product = \App\product::with('categories')->paginate(6);
            $count_data = $product->count();
            return view('customer.content',['product'=> $product],['kategori'=>$kategori],['count_data'=>$count_data]);
        }
       
    }
}
