@extends('customer.layouts.template')
@section('content')

    @if($count_data <= 3)
        <div class="">
    @else
        <div class="warna">
        <div id="shape-1"></div>
        <div id="shape-2">
    @endif           
        </div>
            <div class="container" style="">
                <div class="row align-middle mt-3" style="">  
                    <div class="col-sm-12 mt-3">
                        @if($cat_count > 5)
                        <div class="col-md-12 mx-auto">
                            <table width="100%" style="margin-bottom: 20px;" >
                            <tbody>
                                <tr>
                                    <td class="menu-filter" valign="middle">
                                        @if($count_data <= 3)
                                        <h3 class="cat_fil" id="cat_fil" style="color: #693234;">
                                            Filter Category 
                                        </h3>
                                        @else
                                        <h3 class="cat_fil" id="cat_fil" style="color: #ffffff; ">
                                            Filter Category 
                                        </h3>
                                        @endif
                                    </td>
                                    <td width="60%" align="left" valign="middle" class="menu-logo-filter">
                                        @if($count_data <=3)
                                            <button type="button" class="btn" data-toggle="collapse" data-target="#demo" style="background-color:#FDD8AF; border:none;">
                                                <i class="fas fa-sliders-h tombol" style="color:#693234"></i>
                                            </button>
                                        @else
                                        <button type="button" class="btn" data-toggle="collapse" data-target="#demo" style="background-color:#693234; border:none;">
                                            <i class="fas fa-sliders-h tombol" style="color:#fff;"></i>
                                        </button>
                                        @endif
                                    </td>
                                    <!--
                                    <td width="25%" align="right">
                                        
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb px-0 button_breadcrumb">
                                                    <li class="breadcrumb-item active" aria-current="page" @if($count_data <= 3) style="color: #6a3137;margin-top:30px;" @else style="color: #fff;margin-top:30px;"@endif>Category Family Pack</li>
                                                </ol>
                                            </nav>
                                    </td>
                                -->
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        <div id="demo" class="collapse" style="">
                            <div class="col-md-12" style="margin-bottom: 20px;">
                            <a href="{{url('/home_customer')}}" type="button" class="btn button_add_to_cart button-collapse mb=3">Semua Produk</a>
                            @foreach($categories as $key => $value)
                                <a href="{{route('category.index', ['id'=>$value->id] )}}" type="button" class="btn button_add_to_cart button-collapse mb-3">{{$value->name}}</a>
                            @endforeach
                            </div>
                        </div>
                        @else
                        <div class="col-md-12 mb-2" style="">
                            <a href="{{url('/home_customer')}}" type="button" class="btn button_add_to_cart button-collapse mb-3">Semua Produk</a>
                            @foreach($categories as $key => $value)
                                <a href="{{route('category.index', ['id'=>$value->id] )}}" type="button" class="btn button_add_to_cart button-collapse mb-3">{{$value->name}}</a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="row section_content">
                        @foreach($product as $key => $value)
                        <div id="product_list"  class="col-6 col-md-4 d-flex">
                            <div class="card mx-auto d-flex item_product">
                                <a href="{{URL::route('product_detail', ['id'=>$value->id])}}">
                                    <img style="" src="{{ asset('storage/'.(($value->image!='') ? $value->image : '20200621_184223_0016.jpg').'') }}" class="img-fluid h-150 w-100 img-responsive" alt="...">
                                </a>
                                <div class="float-left px-1 py-2" style="width: 100%;">
                                    <p class="product-price-header mb-0" style="">
                                        {{$value->description}}
                                    </p>
                                </div>
                                <div class="float-left px-1 py-2" style="">
                                    <p style="line-height:1; bottom:0" class="product-price mb-0 " id="productPrice{{$value->id}}" style="">Rp {{ number_format($value->price, 0, ',', '.') }}</p>
                                </div>
                                <table width="100%" class="hdr_tbl_cart mt-auto" style="bottom: 0">
                                    <tbody>
                                        <tr>
                                            <td width="10%" align="right" valign="middle">
                                                    <input type="hidden" id="Product_id{{$value->id}}" name="Product_id" value="{{$value->id}}">
                                                    <input type="hidden" id="quantity_add{{$value->id}}" name="quantity" value="1">
                                                    <input type="hidden" id="harga{{$value->id}}" name="price" value="{{$value->price}}">
                                                    <button class="btn button_minus" onclick="button_minus('{{$value->id}}')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                            </td>
                                            <td width="10%" align="center" valign="middle">
                                                <?php 
                                                $user = \Request::header('User-Agent'); 
                                                $view_pesan = \DB::select("SELECT orders.session_id, orders.status, orders.username, 
                                                            products.description, products.image, products.price, order_product.id,
                                                            order_product.order_id,order_product.product_id,order_product.quantity
                                                            FROM order_product, products, orders WHERE 
                                                            orders.id = order_product.order_id AND order_product.product_id = $value->id AND 
                                                            order_product.product_id = products.id AND orders.status = 'SUBMIT' 
                                                            AND orders.session_id = '$user' AND orders.username IS NULL ");
                                                $hitung = count($view_pesan);
                                                    if($hitung > 0){
                                                        foreach ($view_pesan as $key => $k) {
                                                        echo '<p id="show_'.$value->id.'" class="d-inline show" style="">'.$k->quantity.'</p>';
                                                        echo '<input type="hidden" id="jmlbrg_'.$value->id.'" name="quantity" value="'.$k->quantity.'">';
                                                        }
                                                    }
                                                    else{
                                                        echo '<input type="hidden" id="jmlbrg_'.$value->id.'" name="quantity" value="0">';
                                                        echo '<p id="show_'.$value->id.'" class="d-inline show" style="">0</p>';
                                                    }
                                                ?>
                                            </td>
                                            <td width="10%" align="left" valign="middle">
                                                <button class="btn button_plus" onclick="button_plus('{{$value->id}}')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach
                        <!--
                        <div class="col-md-12">
                            <div class="row justify-content-center" >
                            <div class="page paging" style="margin-top:0; margin-bottom:1rem;">/*$product->appends(Request::all())->onEachSide(5)->links('vendor.pagination.bootstrap-4') */</div>
                            </div>
                        </div>
                        -->        
                    </div>
                </div>
            </div>
        </div>
    
    <!-- Footer section -->
    <footer id="footer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                   <img src="{{ asset('assets/image/logo-gentong.png') }}" class="img-thumbnail" style="background-color:transparent; border:none;" alt="logo-gentong"> 
                </div>
            </div>
            <br><br>
            <div class="row justify-content-center mx-auto" >    
                <div class="social-icons">
                    <a href="https://www.facebook.com/Gentongicecream/"  target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://instagram.com/gentongicecream?igshid=10b120fidnx58"  target="_blank"><i class="fab fa-instagram "></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="https://twitter.com/kedaigentong?s=08" target="_blank"><i class="fab fa-twitter "></i></a>
                </div>
            </div>
            <div class="copyright text-center">
                <p>@Copyright 2020</p>
            </div>
        </div>
    </footer>

    <div id="accordion">
        <div class="card fixed-bottom" style="">
            <div id="card-cart" class="card-header" >
                <table width="100%" style="margin-bottom: 40px;">
                    <tbody>
                        <tr>
                            <td width="5%" valign="middle">
                                <div id="ex4">
                               
                                    <span class="p1 fa-stack fa-2x has-badge" data-count="{{$total_item}}">
                                
                                        <!--<i class="p2 fa fa-circle fa-stack-2x"></i>-->
                                        <i class="p3 fa fa-shopping-cart " data-count="4b" style=""></i>
                                    </span>
                                </div> 
                            </td>
                            <td width="25%" align="left" valign="middle">
                                @if($item!==null)
                            <h5 id="total_kr_">Rp. {{number_format($item->total_price , 0, ',', '.')}}</h5>
                            <input type="hidden" id="total_kr_val" value="{{$item->total_price}}">
                                @else
                            <h5 id="total_kr_">Rp. 0</h5>
                            <input type="hidden" id="total_kr_val" value="0">
                                @endif
                            </td>
                            <td width="5%" valign="middle" >
                            <a id="cv" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4" class="collapsed">
                                    <i class="fas fa-chevron-up" style=""></i>
                                </a>
                            </td>
                            <td width="33%" align="right" valign="middle">
                               
                            <h5>({{$total_item}} Item)</h5>
                             
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="{{$total_item > 0 ? 'collapse-4' : '' }}" class="collapse" data-parent="#accordion">
                <div class="card-body" id="card-detail" style="">
                    <div class="col-md-12">
                        <table width="100%" style="margin-bottom: 40px;">
                            <tbody>
                                @foreach($keranjang as $detil)
                                <tr>
                                    <td width="25%" valign="middle">
                                        <img src="{{ asset('storage/'.$detil->image)}}" 
                                        class="image-detail"  alt="...">   
                                    </td>
                                    <td width="60%" align="left" valign="top">
                                        <p class="name-detail">{{ $detil->description}}</p>
                                        <?php $total=$detil->price * $detil->quantity;?>
                                        <h1 id="productPrice_kr{{$detil->product_id}}" style="color:#6a3137; !important; font-family: Open Sans;">Rp. {{ number_format($total, 0, ',', '.') }}</h1>
                                        <table width="10%">
                                            <tbody>
                                                <tr>
                                                    <td width="10px" align="left" valign="middle">
                                                        <input type="hidden" id="order_id{{$detil->product_id}}" name="order_id" value="{{$detil->order_id}}">
                                                        <input type="hidden" id="harga_kr{{$detil->product_id}}" name="price" value="{{$detil->price}}">
                                                        <input type="hidden" id="id_detil{{$detil->product_id}}" value="{{$detil->id}}">
                                                        <input type="hidden" id="jmlkr_{{$detil->product_id}}" name="quantity" value="{{$detil->quantity}}">    
                                                        <button class="button_minus" onclick="button_minus_kr('{{$detil->product_id}}')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                    </td>
                                                    <td width="10px" align="middle" valign="middle">
                                                        <p id="show_kr_{{$detil->product_id}}" class="d-inline" style="">{{$detil->quantity}}</p>
                                                    </td>
                                                    <td width="10px" align="right" valign="middle">
                                                        <button class="button_plus" onclick="button_plus_kr('{{$detil->product_id}}')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="15%" align="right" valign="top" style="padding-top: 5%;">
                                        <button class="btn btn-default" onclick="delete_kr('{{$detil->product_id}}')" style="">X</button>
                                        <input type="hidden"  id="order_id_delete{{$detil->product_id}}" name="order_id" value="{{$detil->order_id}}">
                                        <input type="hidden"  id="quantity_delete{{$detil->product_id}}" name="quantity" value="{{$detil->quantity}}">
                                        <input type="hidden"  id="price_delete{{$detil->product_id}}" name="price" value="{{$detil->price}}">
                                        <input type="hidden"  id="product_id_delete{{$detil->product_id}}"name="product_id" value="{{$detil->product_id}}">
                                        <input type="hidden" id="id_delete{{$detil->product_id}}" name="id" value="{{$detil->id}}">
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td align="right" colspan="3">
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
                <div class="fixed-bottom p-3">
                    @if($total_item > 0)
                        <a type="button" class="btn button_add_to_pesan btn-block" data-toggle="modal" data-target="#my_modal_content">Beli Sekarang</a>
                     @endif
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="my_modal_content" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="background: #FDD8AF">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                    </div>
                    <form method="POST" target="_BLANK" action="{{ route('customer.keranjang.pesan') }}">
                        @csrf
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-sm-12">
                                <div class="card contact_card" style="border-radius:15px;">
                                    <div class="card-body">
                                        <div class="form-group">
                                            @if($item!==null)
                                            <input type="hidden" name="total_pesanan" id="total_pesan_val" value="{{$item->total_price}}">
                                                @else
                                            <input type="hidden" name="total_pesanan" id="total_pesan_val" value="0">
                                             @endif
                                            
                                        <input type="text" value="{{$item_name !== null ? $item_name->username : ''}}" name="username" class="form-control contact_input @error('name') is-invalid @enderror" placeholder="Name" id="name" required autocomplete="off" autofocus value="{{ old('name') }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <hr style="border-top:1px solid rgba(116, 116, 116, 0.507);">
                                        <div class="form-group">
                                            <input type="email" value="{{$item_name !== null ? $item_name->email : ''}}" name="email" class="form-control contact_input @error('email') is-invalid @enderror" placeholder="Email" id="email" required autocomplete="off" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <hr style="border-top:1px solid rgba(116, 116, 116, 0.507);">
                                        <div class="form-group">
                                            <textarea type="text"  name="address" class="form-control contact_input @error('address') is-invalid @enderror" placeholder="Address" id="address" required autocomplete="off" value="{{ old('address') }}">{{$item_name !== null ? $item_name->address : ''}}</textarea>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <hr style="border-top:1px solid rgba(116, 116, 116, 0.507);">
                                        <div class="form-group">
                                            <input type="text" value="{{$item_name !== null ? $item_name->phone : ''}}" name="phone"  minlength="10" maxlength="13" class="form-control contact_input" placeholder="Phone" id="phone" required autocomplete="off" onkeypress="return hanyaAngka(event)">
                                            <!--<label for="password-confirm" class="contact_label">{{ __('Konfirmasi Kata Sandi') }}</label>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <input type="hidden" id="order_id_pesan" name="id" value="{{$item !==null ? $item->id : ''}}"/>
                        <button type="submit" class="btn btn-block bt-wa" onclick="pesan_wa()"  style="color:#fff; background-color:#6a3137; "><i class="fab fa-whatsapp" style="font-weight: bold;"></i> &nbsp;{{__('Pesan') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


