<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class productController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';
        if($status){
        $products = \App\product::with('categories')
        ->where('Product_name','LIKE',"%$keyword%")
        ->where('status',strtoupper($status))->get();//->paginate(10);
        }
        else
            {
            $products = \App\product::with('categories')
            ->where('Product_name','LIKE',"%$keyword%")->get();
            //->paginate(10);
            }
        return view('products.index', ['products'=> $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            "Product_name" => "required|min:0|max:200",
            "description" => "required|min:0|max:1000",
            "image" => "required",
            "price" => "required|digits_between:0,10",
            "stock" => "required|digits_between:0,10"
        ])->validate(); 

        $new_product = new \App\product;
        $new_product->Product_name = $request->get('Product_name');
        $new_product->description = $request->get('description');
        $new_product->price = $request->get('price');
        $new_product->stock = $request->get('stock');
        $new_product->status = $request->get('save_action');
        $new_product->slug = \Str::slug($request->get('Product_name'));
        $new_product->created_by = \Auth::user()->id;
        $image = $request->file('image');
      
        if($image){
          $image_path = $image->store('products-images', 'public');
      
          $new_product->image = $image_path;
        }
      
        $new_product->save();

        $new_product->categories()->attach($request->get('categories'));
      
        if($request->get('save_action') == 'PUBLISH'){
          return redirect()
                ->route('products.create')
                ->with('status', 'Product successfully saved and published');
        } else {
          return redirect()
                ->route('Products.create')
                ->with('status', 'Product saved as draft');
        }
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
        $product = \App\product::findOrFail($id);
        return view('products.edit', ['product' => $product]);
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
        $product = \App\product::findOrFail($id);
        $product->Product_name = $request->get('Product_name');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->stock = $request->get('stock');
        $product->slug = $request->get('slug');
        $new_image = $request->file('image');
        if($new_image){
        if($product->image && file_exists(storage_path('app/public/'.$product->image))){
        \Storage::delete('public/'. $product->image);
        }
        $new_image_path = $new_image->store('products-images', 'public');
        $product->image = $new_image_path;
        }
        $product->updated_by = \Auth::user()->id;
        $product->status = $request->get('status');
        $product->save();
        $product->categories()->sync($request->get('categories'));
        return redirect()->route('products.edit', [$product->id])->with('status',
        'Product successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = \App\product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('status', 'Product moved to
        trash');
    }

    public function trash(){
        $products = \App\product::onlyTrashed()->get();//->paginate(10);

        return view('products.trash', ['products' => $products]);
    }

    public function restore($id){

        $product = \App\product::withTrashed()->findOrFail($id);
        if($product->trashed()){
        $product->restore();
        return redirect()->route('products.trash')->with('status', 'Product successfully restored');
        } else {
        return redirect()->route('products.trash')->with('status', 'Product is not in trash');
        }
    }

    public function deletePermanent($id){

        $product = \App\product::withTrashed()->findOrFail($id);
        if(!$product->trashed()){
        return redirect()->route('products.trash')->with('status', 'Product is not in trash!')->with('status_type', 'alert');
        } else {
        $product->categories()->detach();
        $product->forceDelete();
        return redirect()->route('products.trash')->with('status', 'Product permanently deleted!');
        }

    }
}
