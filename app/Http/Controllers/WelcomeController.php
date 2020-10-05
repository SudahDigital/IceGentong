<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {   
        
        $kategori = \App\Category::get();
        $product = \App\product::with('categories')->paginate(6);
        $count_data = $product->count();
        return view('customer.content',['product'=> $product],['kategori'=>$kategori],['count_data'=>$count_data]);
    }
}
