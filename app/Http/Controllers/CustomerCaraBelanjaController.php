<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerCaraBelanjaController extends Controller
{
    public function index(Request $request)
    {    
        $kategori = \App\Category::get();	
    	return view('customer.carabelanja',['kategori'=>$kategori]);
    }
}
