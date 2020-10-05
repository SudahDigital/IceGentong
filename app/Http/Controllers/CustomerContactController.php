<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerContactController extends Controller
{
    public function index()
    {   
        $kategori = \App\Category::get();
    	return view('customer.contact',['kategori'=>$kategori]);
    }
}
