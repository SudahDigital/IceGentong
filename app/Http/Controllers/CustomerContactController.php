<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerContactController extends Controller
{
    public function index()
    {
    	return view('customer.contact');
    }
}
