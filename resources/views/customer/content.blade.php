@extends('customer.layouts.template')
@section('content')
    <div class="warna">
        <div class="container" style="margin-top:30px;">
            <div class="row align-middle" style="margin-bottom: 20px">
                <div class="col-sm-12">
                    
                        <div class="col-md-12 mx-auto">
                            <table width="100%" style="margin-bottom: 40px;">
                            <tbody>
                                <tr>
                                    <td width="25%">
                                        <h3 class="title-page" style="font-size: 30px;font-weight: bold;font-style: normal;line-height: 1.37;color: #ffffff; font-family: Open Sans;">
                                            Filter Category 
                                        </h3>
                                    </td>
                                    <td width="75%">
                                        <button type="button" class="btn" data-toggle="collapse" data-target="#demo" style="background-color:#693234; border:none;">
                                            <i class="fas fa-sliders-h fa-2x" style="color:#fff;"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        
                        <div id="demo" class="collapse" style="margin-bottom:50px;">
                            <div class="col-md-12" style="margin-bottom: 20px;">
                            <button type="button" class="btn button_add_to_cart button-collapse">Semua Produk</button>
                            
                            <button type="button" class="btn button_add_to_cart button-collapse">Special Package</button>
                            
                            <button type="button" class="btn button_add_to_cart button-collapse">Deluxe</button>
                            
                            <button type="button" class="btn button_add_to_cart button-collapse">Family Pack</button>
                            
                            <button type="button" class="btn button_add_to_cart">Purty Cup</button>
                            </div>
                            
                        </div> 
                        
                    
                </div>
               
                <br>
                <div class="row section_content">
                   @foreach($product as $key => $value)
                    <div class="col-md-4 ">

                        <div class="card mx-auto item_product">
                            <a href="{{URL::route('product_detail', ['id'=>$value->id, 'product_name'=>urlencode($value->Product_name)])}}">
                                <img style="border-radius:15px; height:250px;" src="{{ asset('storage/'.(($value->image!='') ? $value->image : '20200621_184223_0016.jpg').'') }}" class="img-fluid h-150 w-100 img-responsive" alt="...">
                                <!-- <h5 class="card-title product-name px-1 py-2 mb-0" style="background-color: #4db849 !important; color: #fff !important; position: absolute; bottom: 0; width: 100%; opacity: 0.8;">{{$value->product_name}}</h5> -->
                            </a>
                            
                                <div class="float-left px-1 py-2" style="width: 100%;">
                                    <p class="product-price-header mb-0" style="color:#6a3137 !important; line-height: 1.36;font-size: 25px;font-weight: bold;">
                                        {{$value->description}}
                                    </p>
                                </div>
                                <div class="float-left px-1 py-2" style=" width: 100%; font-size: 45px; font-weight: 800;">
                                    <p class="product-price mb-0" id="productPrice{{$value->id}}" style="color:#6a3137; !important; font-family: Open Sans;">Rp {{ number_format($value->price, 0, ',', '.') }}</p>
                                </div>
                                
                                
                                <table width="100%">
                                    <tbody>
                                    <tr>
                                        <td width="70%" valign="middle" style="padding-right:20px;">
                                            <form method="post" action="">
                                                @csrf
                                                <input type="hidden" id="{{$value->id}}" name="jumlah" value="1">
                                                <input type="hidden" id="harga{{$value->id}}" name="harga" value="{{ $value->price }}">
                                                <input type="hidden" name="product_id" value="{{$value->id}}">
                                                <button class="btn btn-block button_add_to_cart" style="font-size: 20px;font-weight: 800; padding:2 15;">Tambah</button>
                                            </form>
                                        </td>
                                        <td width="10%" align="left" valign="middle">
                                            <a class="button_minus" onclick="button_minus('{{$value->id}}')" style=" color:#6a3137;font-size: 20px;font-weight: 800; cursor:pointer;"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                        </td>
                                        <td width="10%" align="center" valign="middle">
                                            <p id="show_{{$value->id}}" class="d-inline" style="color:#6a3137; font-size: 20px;font-weight: 800;">1</p>
                                        </td>
                                        <td width="10%" align="right" valign="middle">
                                            <a class="button_plus float-right " onclick="button_plus('{{$value->id}}')" style="color:#6a3137;font-size: 20px;font-weight: 800; cursor:pointer;"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                
                            
                        </div>

                    </div>
                @endforeach
                        
                <div class="row justify-content-md-center mx-auto" >
                    <div style="margin-top:-7rem; margin-bottom:7rem;">{{ $product->links('vendor.pagination.bootstrap-4') }}</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer section -->
    <footer id="footer">
                
        <div class="container">

            
            <div class="row justify-content-center mx-auto" >
                <img src="{{ asset('assets/image/logo-nav.png') }}" width="55%" height="auto">
            </div>
            <br><br>
            <div class="row justify-content-center mx-auto" >    
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram "></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-twitter "></i></a>
                </div>
            </div>
                <div class="copyright text-center">
                    <p>@Copyright 2020</p>
                </div>
                
        </div>
        
    </footer>

    <div id="accordion">
        <div class="card fixed-bottom" style="border-radius:10px; margin-left:50px;margin-right:50px;">
            <div id="card-cart" class="card-header" >
                <table width="100%" style="margin-bottom: 40px;">
                    <tbody>
                        <tr>
                            <td width="10%" valign="middle">
                                <div id="ex4">
                                    <span class="p1 fa-stack fa-2x has-badge" data-count="5">
                                        <!--<i class="p2 fa fa-circle fa-stack-2x"></i>-->
                                        <i class="p3 fa fa-shopping-cart fa-2x" data-count="4b" style="color: #ffffff"></i>
                                    </span>
                                </div> 
                            </td>
                            <td width="37%" align="left">
                                <h4>Rp.</h4>
                            </td>
                            <td width="33%" valign="top">
                            <a role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4" class="collapsed">
                                    <i class="fas fa-chevron-down" style="color: #ffffff; margin-top:1px; ali"></i>
                                </a>
                            </td>
                            <td width="33%" align="right">
                                <h4>(0 Item)</h4>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="collapse-4" class="collapse" data-parent="#accordion"  >
                <div class="card-body" >
                Detail
                </div>
            </div>
        </div>
    </div>
@endsection
