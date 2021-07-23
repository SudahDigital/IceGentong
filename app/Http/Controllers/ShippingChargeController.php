<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class ShippingChargeController extends Controller
{
    public function __construct(){
        $this->middleware(function($request, $next){
            
            if(Gate::allows('manage-categories')) return $next($request);

            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $shipping = \App\ShippingCost::get();//paginate(10);
        
        return view('shippings.index', ['shipping'=>$shipping]);
    }

    public function edit($id)
    {
        $shipping = \App\ShippingCost::findOrFail($id);
        return view('shippings.edit',['shipping'=>$shipping]);
    }

    public function update(Request $request, $id)
    {
        $price = $request->get('price');
        $status = $request->get('status');
        
        $cost = \App\ShippingCost::findOrFail($id);

        if($status == 'ON'){
        	$cost->price = $price;
        }

        $cost->set_cost = $status;
        $cost->save();

        return redirect()->route('shippings.edit', [$id])->with('status','Shipping Cost Succsessfully Update');
    }
}
