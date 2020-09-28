@extends('template')
@section('content')
    <div class="container" style="margin-top: 70px;">
        <div class="row align-middle">
            <div class="col-sm-12 col-md-12">
                <nav aria-label="breadcrumb" class="">
                    <ol class="breadcrumb px-0 button_breadcrumb">
                        <li class="breadcrumb-item" style="color: #4db849 !important;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row section_content">
            <div class="col-sm-12 col-md-6 mb-3">
                <div class="card mx-auto item_product">
                    <img src="{{ asset('assets/image/product/'.(($product->image_link!='') ? $product->image_link : '20200621_184223_0016.jpg').'') }}" class="card-img-top img-fluid" alt="...">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <div class="card mx-auto item_product">
                    <div class="card-body m-0 p-0">
                        <h5 class="card-title product-name px-3 pt-3">{{$product->product_name}}</h5>
                        <p class="product-description px-3">{{$product->product_description}}</p>
                        <div>
                            <div class="float-left p-2" style="width: 70%; background-color: #dfe7d9 !important; clip-path: polygon(0 0, 100% 0%, 75% 100%, 0% 100%);">
                                <p class="product-price mb-0 px-2" id="productPrice{{$product->id}}" style="color: #000 !important;">Rp {{ number_format($product->product_harga, 0, ',', '.') }}</p>
                            </div>
                            <div class="float-right p-2 text-center" style="width: 30%;">
                                <button class="btn btn-success button_plus float-right mr-2" onclick="button_plus_detail('{{$product->id}}')" style="padding: 0; text-align: center; border-radius: 100%;">+</button>
                                <p id="show_detail_{{$product->id}}" class="mr-1 ml-1 d-inline" style="color: #000 !important;">1</p>
                                <button class="float-left btn btn-success button_minus" onclick="button_minus_detail('{{$product->id}}')" style="padding: 0; text-align: center; border-radius: 100%;">-</button>
                            </div>          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row section_content">
            <div class="col-12 mb-5">
                <div class="mx-auto">
                    <div class="clearfix">
                        <form method="post" action="{{route('add_cart')}}">
                            @csrf
                            <input type="hidden" id="{{$product->id}}" name="jumlah" value="1">
                            <input type="hidden" id="harga{{$product->id}}" name="harga" value="{{ $product->product_harga }}">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <button class="btn btn-block btn-success button_add_to_cart">Tambah Ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>
@endsection
