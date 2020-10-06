@extends('customer.layouts.template-nocart')
@section('content')
        <div class="container" style="margin-top: 80px;">
            <div class="row align-middle">
                <div class="col-sm-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb px-0 button_breadcrumb">
                            <li class="breadcrumb-item" style="color: #6a3137 !important;margin-top:30px; margin-left:30px;"><a href="{{Auth::user() ? url('/home_customer') : url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page" style="margin-top:30px;">Detail Produk</li>
                        </ol>
                    </nav>
                </div>
            </div>
        
            <div class="row section_content">
                <div class="col-sm-12 col-md-6 mb-3">
                    <div class="card mx-auto item_product" style="padding-bottom: 0;">
                        <img style="width:100%; height:auto;" src="{{ asset('storage/'.(($product->image!='') ? $product->image : '20200621_184223_0016.jpg').'') }}" class="card-img-top img-fluid" alt="...">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 mb-3">
                    <div class="card mx-auto item_product">
                        <div class="card-body m-0 p-0">
                            <div class="float-left px-1 py-2" style="width: 100%;">
                                <h1 class="roduct-price-header mb-0" style="color:#6a3137 !important; font-weight:900;">{{$product->Product_name}}</h1>
                                <p class="product-price-header mb-0" style="">
                                    {{$product->description}}
                                </p>
                            </div>
                            
                            <div>
                                <div class="float-left p-2">
                                    <p class="product-price mb-0 " id="productPrice{{$product->id}}" >Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                                
                                    <table width="100%" class="hdr_tbl_cart">
                                        <tbody>
                                        <tr>
                                            <td class="tbl_cart" valign="middle" style="">
                                                <form method="post" action="{{ route('customer.keranjang.simpan') }}">
                                                    @csrf
                                                    @if(Route::has('login'))
                                                        @auth
                                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                        @endauth
                                                    @endif
                                                    <input type="hidden" id="{{$product->id}}" name="quantity" value="1">
                                                    <input type="hidden" id="harga{{$product->id}}" name="price" value="{{ $product->price }}">
                                                    <input type="hidden" name="Product_id" value="{{$product->id}}">
                                                    <button class="btn btn-block button_add_to_cart respon" style="">Tambah</button>
                                                </form>
                                            </td>
                                            <td width="7%" align="left" valign="middle">
                                                <a class="button_minus" onclick="button_minus('{{$product->id}}')" style=""><i class="fa fa-minus" aria-hidden="true"></i></a>
                                            </td>
                                            <td width="7%" align="center" valign="middle">
                                                <p id="show_{{$product->id}}" class="d-inline show" style="">1</p>
                                            </td>
                                            <td width="7%" align="right" valign="middle">
                                                <a class="button_plus float-right " onclick="button_plus('{{$product->id}}')" style=""><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="row section_content">
            <div class="col-12 mb-5">
                <div class="mx-auto">
                    <div class="clearfix">
                        <form method="post" action="">
                            
                            <input type="hidden" id="" name="jumlah" value="1">
                            <input type="hidden" id="harga" name="harga" value="">
                            <input type="hidden" name="product_id" value="">
                            <button class="btn btn-block btn-success button_add_to_cart">Tambah Ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>-->
        <br><br><br>
    
@endsection
