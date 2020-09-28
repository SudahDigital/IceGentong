<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $product = \App\product::with('categories')->paginate(6);
        return view('customer.content',['product'=> $product]);
    }
}
