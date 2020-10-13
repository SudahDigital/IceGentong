@extends('customer.layouts.template')
@section('content')

@if(session()->has('status'))
<div class="container">
    <div class="row justify-content-center">
        
            <div class="alert alert-success" role="alert" style="position:fixed;top:20%; width:80%; z-index:9999; margin: 0 auto; background:#FDD8AF; border:none; color:#6a3137; font-weight:bold;">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                {{session()->get('status')}}
            </div>
        
    </div>
</div>

@endif
    @if($count_data <= 3)
    <div class="">
    @else
    <div class="warna">
        
    @endif
        
            <div class="container" style="margin-top:30px;">
                <div class="row align-middle" style="margin-bottom: 20px">
                    <div class="col-sm-12">
                        
                        <div class="col-md-12 mx-auto">
                            <table width="100%" style="margin-bottom: 20px;">
                            <tbody>
                                <tr>
                                    <td class="menu-filter">
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
                                    <td width="60%" align="left">
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
                            <a href="{{url('/home_customer')}}" type="button" class="btn button_add_to_cart button-collapse">Semua Produk</a>
                            @foreach($categories as $key => $value)
                                <a href="{{route('category.index', ['id'=>$value->id] )}}" type="button" class="btn button_add_to_cart button-collapse">{{$value->name}}</a>
                            @endforeach
                            </div>
                        </div> 
                    
                    </div>
                   
                    <br>
                    <div class="col-md-12">
                        <div class="row section_content">
                        @foreach($product as $key => $value)
                            <div class="col-6 col-lg-4">
    
                                <div class="card mx-auto item_product">
                                    <a href="{{URL::route('product_detail', ['id'=>$value->id])}}">
                                        <img style="" src="{{ asset('storage/'.(($value->image!='') ? $value->image : '20200621_184223_0016.jpg').'') }}" class="img-fluid h-150 w-100 img-responsive" alt="...">
                                    </a>
                                        <div class="float-left px-1 py-2" style="width: 100%;">
                                            <p class="product-price-header mb-0" style="">
                                                {{$value->description}}
                                            </p>
                                        </div>
                                        <div class="float-left px-1 py-2" style="">
                                            <p style="line-height:1;" class="product-price mb-0 " id="productPrice{{$value->id}}" style="">Rp {{ number_format($value->price, 0, ',', '.') }}</p>
                                        </div>
                                        
                                        
                                        <table width="100%" class="hdr_tbl_cart">
                                            <tbody>
                                            <tr><!--
                                                <td class="tbl_cart" valign="middle" style="">
                                                </td>-->
                                                <!--<button class="btn btn-block button_add_to_cart respon" style="">Tambah</button>-->
                                                <td width="10%" align="right" valign="middle">
                                                     <a class="button_minus" onclick="button_minus('{{$value->id}}')" style=""><i class="fa fa-minus" aria-hidden="true"></i></a>
                                                </td>
                                                <td width="10%" align="center" valign="middle">
                                                     <p id="show_{{$value->id}}" class="d-inline show" style="">0</p>
                                                </td>
                                                <td width="10%" align="left" valign="middle">
                                                    <form method="post" action="{{ route('customer.keranjang.simpan') }}">
                                                        @csrf
                                                        <input type="hidden" name="Product_id" value="{{$value->id}}">
                                                        <input type="hidden" id="{{$value->id}}" name="quantity" value="1">
                                                        <input type="hidden" id="harga{{$value->id}}" name="price" value="{{$value->price}}">
                                                        <button class="btn button_plus" onclick="button_plus('{{$value->id}}')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                    </form> 
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
        
        
    </div>
    
    <!-- Footer section -->
    <footer id="footer">
                
        <div class="container">

            
            <div class="row justify-content-center mx-auto" >
                <img src="{{ asset('assets/image/ecim-gentong.png') }}" width="55%" height="auto">
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
                            <h5 id="total_kr_{{$item->total_price}}">Rp.
                                {{number_format($item->total_price)}}
                                @else
                            <h5 id="total_kr_0">Rp.
                                {{''}}
                                @endif
                            
                            </h5>
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
            <div id="collapse-4" class="collapse" data-parent="#accordion" style="" >
                <div class="card-body" id="card-detail">
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
                                        <h1 id="productPrice_kr{{$detil->product_id}}" style="color:#6a3137; !important; font-family: Open Sans;">Rp {{ number_format($total, 0, ',', '.') }}</h1>
                                        <table width="10%">
                                            <tbody>
                                                <tr>
                                                    
                                                    <td width="10px" align="left" valign="middle">
                                                        <form method="post" action="{{ route('customer.keranjang.kurang') }}">
                                                            @csrf
                                                            <input type="hidden" name="order_id" value="{{$detil->order_id}}">
                                                            <input type="hidden" id="harga_kr{{$detil->product_id}}" name="price" value="{{$detil->price}}">
                                                            <input type="hidden" name="id" value="{{$detil->id}}">
                                                            <input type="hidden" id="jmlkr_{{$detil->product_id}}" name="quantity" value="{{$detil->quantity}}">    
                                                            <button class="button_minus" onclick="button_minus_kr('{{$detil->product_id}}')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                        </form>
                                                    </td>
                                                    <td width="10px" align="middle" valign="middle">
                                                        <p id="show_kr_{{$detil->product_id}}" class="d-inline" style="">{{$detil->quantity}}</p>
                                                    </td>
                                                    <td width="10px" align="right" valign="middle">
                                                        <form method="post" action="{{ route('customer.keranjang.tambah') }}">
                                                            @csrf
                                                            <input type="hidden" name="order_id" value="{{$detil->order_id}}">
                                                            <input type="hidden" id="harga_kr{{$detil->product_id}}" name="price" value="{{$detil->price}}">
                                                            <input type="hidden" name="id" value="{{$detil->id}}">
                                                            <input type="hidden" id="jmlkr_{{$detil->product_id}}" name="quantity" value="{{$detil->quantity}}">    
                                                            <button class="button_plus" onclick="button_plus_kr('{{$detil->product_id}}')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                        </form>
                                                    </td>
                                                   
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="15%" align="right" valign="top" style="padding-top: 5%;">
                                        <form method="post" action="{{ route('customer.keranjang.delete') }}">
                                            @csrf
                                            <button class="btn btn-default" 
                                             style="">X</button>
                                            <input type="hidden"  name="order_id" value="{{$detil->order_id}}">
                                            <input type="hidden"  name="quantity" value="{{$detil->quantity}}">
                                            <input type="hidden"  name="price" value="{{$detil->price}}">
                                            <input type="hidden"  name="product_id" value="{{$detil->product_id}}">
                                            <input type="hidden" id="{{$detil->id}}" name="id" value="{{$detil->id}}">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td align="right" colspan="3">
                                            
                                            
                                            @if($total_item > 0)
                                            <a type="button" class="btn button_add_to_cart" data-toggle="modal" data-target="#myModal">Beli Sekarang</a>
                                            @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
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
                        
                            @csrf
                            <div class="card mx-auto contact_card" style="border-radius:15px;">
                                <div class="card-body">
                                    <div class="form-group">
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
                                        <input type="number" value="{{$item_name !== null ? $item_name->phone : ''}}" name="phone" class="form-control contact_input" placeholder="Phone" id="phone" required autocomplete="off">
                                        <!--<label for="password-confirm" class="contact_label">{{ __('Konfirmasi Kata Sandi') }}</label>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mx-auto text-center">
                                
                            </div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <input type="hidden" name="id" value="{{$item !==null ? $item->id : ''}}"/>
                <button type="submit" class="btn button_add_to_cart"  style="background-color: #4AC959;"><i class="fab fa-whatsapp" style="font-weight: bold;"></i> {{__('Pesan') }}</button>
            </div>
            </form>
        </div>
        
        </div>
    </div>

    <script type='text/javascript'>
       function button_minus_kr(id)
        {
            var jumlah = $('#jmlkr_'+id).val();
            var jumlah = parseInt(jumlah) - 1;

            // AMBIL NILAI HARGA
            var harga = $('#harga_kr'+id).val();
            var harga = parseInt(harga) * jumlah;

            //AMBIL NILAI TOTAL
            var totalkr = $('#tt_'+id).val();
            var totalkr = parseInt(totalkr) - harga;
            // UBAH FORMAT UANG INDONESIA
            var	number_string = harga.toString();
            var sisa 	= number_string.length % 3;
            var rupiah 	= number_string.substr(0, sisa);
            var ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
            }

            harga = "Rp " + rupiah;

            if (jumlah<1) {
            alert('Jumlah order minimal 1, jika ingin mengurangi order silahkan delete..')
            } else {
            $('#jmlkr_'+id).val(jumlah);
            $('#show_kr_'+id).html(jumlah);
            $('#productPrice_kr'+id).text(harga);
            $('#totalKr_'+id).text(totalkr);
            }
        }

        function button_plus_kr(id)
        {
            var jumlah = $('#jmlkr_'+id).val();
            var jumlah = parseInt(jumlah) + 1;

            // AMBIL NILAI HARGA
            var harga = $('#harga_kr'+id).val();;
            var harga = parseInt(harga) * jumlah;

            // UBAH FORMAT UANG INDONESIA
            var	number_string = harga.toString();
            var sisa 	= number_string.length % 3;
            var rupiah 	= number_string.substr(0, sisa);
            var ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
            }

            harga = "Rp " + rupiah;
            
            // alert(jumlah)
            if (jumlah<1) {
            alert('Jumlah Tidak Boleh Kosong')
            } else {
            $('#jmlkr_'+id).val(jumlah)
            $('#show_kr_'+id).html(jumlah)
            $('#productPrice_kr'+id).text(harga);
            }
        }
    </script>
    <script>
        form.onsubmit = function() {
     var oldCookie = document.cookie;

     var cookiePoll = setInterval(function() {
         if(oldCookie != document.cookie) {
             // stop polling
             clearInterval(cookiePoll);

             // assuming a login happened, reload page
             window.location.reload();
         }
     },1000); // check every second
}
    </script>
    
@endsection
