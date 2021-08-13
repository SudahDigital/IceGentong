<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

use App\ShippingCost;

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
        $shipping = DB::table('shipping_cost')
        			->leftjoin('cities','shipping_cost.city','=','cities.id')
        			->select('shipping_cost.*','cities.city_name')
        			->get();
        
        return view('shippings.index', ['shipping'=>$shipping]);
    }

    public function create()
    {
    	$cities = \App\Cities::all();
        return view('shippings.create', ['cities'=>$cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $price = $request->get('price');
        $status = $request->get('status');
        $city = $request->get('cities');

        $newCost = new \App\ShippingCost;
        $newCost->price = $price;
        $newCost->city = $city;
        $newCost->set_cost = $status;
        
        $newCost->save();
        return redirect()->route('shippings.create')->with('status','Category Succesfully Created'); 
    }

    public function edit($id)
    {
        $shipping = \App\ShippingCost::findOrFail($id);
        $city = DB::table('shipping_cost')
        			->leftjoin('cities','shipping_cost.city','=','cities.id')
        			->select('cities.city_name')
        			->where('shipping_cost.id','=',$id)
        			->first();

        return view('shippings.edit',['shipping'=>$shipping, 'city'=>$city]);
    }

    public function update(Request $request, $id)
    {
        $price = $request->get('price');
        $status = $request->get('status');
        $city = $request->get('cities');
        
        $cost = \App\ShippingCost::findOrFail($id);

        if($status == 'ON'){
        	$cost->price = $price;
        }
        $cost->set_cost = $status;
        $cost->save();

        return redirect()->route('shippings.edit', [$id])->with('status','Shipping Cost Succsessfully Update');
    }

    public function ajaxSearch(Request $request){
        $keyword = $request->get('q');
        $cities = \App\Cities::where('city_name','LIKE',"%$keyword%")->get();
        return $cities;

        print_r($cities);
    }

    public function delete($id, Request $request)
	{

		$delete = ShippingCost::where('id',$id)->delete();

		if($delete){
        	return redirect()->route('shippings.index')->with('status', 'Shipping Cost Succesfully deleted');
        }
	}
}
