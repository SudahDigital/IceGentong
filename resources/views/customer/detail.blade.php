@extends('customer.layouts.template-nocart')
@section('content')
@if(session()->has('status'))
<div class="container">
    <div class="row justify-content-center">
        
            <div class="alert alert-success" role="alert" style="position:fixed;top:20%; width:80%; z-index:9999; margin: 0 auto; background:#6a3137; border:none; color:#FDD8AF; font-weight:bold;">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                {{session()->get('status')}}
            </div>
        
    </div>
</div>

@endif
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
                                <h4 class="roduct-price-header mb-0" style="color:#6a3137 !important; font-weight:900;">{{$product->Product_name}}</h4>
                                <hr style="border-top:1px solid #6a3137;">
                                <p class="product-price-header mb-0" style="">
                                    {{$product->description}}
                                </p>
                            </div>
                            
                            <div>
                                <div class="float-left p-2" >
                                    <p style="line-height: 1;" class="product-price mb-0 " id="productPrice{{$product->id}}" >Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                                
                                <table width="100%" class="hdr_tbl_cart">
                                    <tbody>
                                    <tr><!--
                                        <td class="tbl_cart" valign="middle" style="">
                                        </td>-->
                                        <!--<button class="btn btn-block button_add_to_cart respon" style="">Tambah</button>-->
                                        <td width="10%" align="right" valign="middle">
                                            <form method="post" action="{{ route('customer.keranjang.min_order') }}">
                                                @csrf
                                                <input type="hidden" name="Product_id" value="{{$product->id}}">
                                                <input type="hidden" id="" name="quantity" value="1">
                                                <input type="hidden" id="harga{{$product->id}}" name="price" value="{{$product->price}}">
                                                <button class="btn button_minus" onclick="button_minus('{{$product->id}}')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                        <td width="10%" align="center" valign="middle">
                                            <?php 
                                            $user = \Request::header('User-Agent'); 
                                            $view_pesan = \DB::select("SELECT orders.session_id, orders.status, orders.username, 
                                                        products.description, products.image, products.price, order_product.id,
                                                        order_product.order_id,order_product.product_id,order_product.quantity
                                                        FROM order_product, products, orders WHERE 
                                                        orders.id = order_product.order_id AND order_product.product_id = $product->id AND 
                                                        order_product.product_id = products.id AND orders.status = 'SUBMIT' 
                                                        AND orders.session_id = '$user' AND orders.username IS NULL ");
                                            $hitung = count($view_pesan);
                                                if($hitung > 0){
                                                    foreach ($view_pesan as $key => $k) {
                                                    echo '<p id="show_'.$product->id.'" class="d-inline show" style="">'.$k->quantity.'</p>';
                                                    echo '<input type="hidden" id="jmlbrg_'.$product->id.'" name="quantity" value="'.$k->quantity.'">';
                                                    }
                                                }
                                                else{
                                                    echo '<input type="hidden" id="jmlbrg_'.$product->id.'" name="quantity" value="0">';
                                                    echo '<p id="show_'.$product->id.'" class="d-inline show" style="">0</p>';
                                                }
                                            ?>
                                        </td>
                                        <td width="10%" align="left" valign="middle">
                                            <form method="post" action="{{ route('customer.keranjang.simpan') }}">
                                                @csrf
                                                
                                                <input type="hidden" name="Product_id" value="{{$product->id}}">
                                                <input type="hidden" id="" name="quantity" value="1">
                                                <input type="hidden" id="harga{{$product->id}}" name="price" value="{{$product->price}}">
                                                <button class="btn button_plus" onclick="button_plus('{{$product->id}}')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </form> 
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
       
        <br><br><br>

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
                    <button type="submit" class="btn button_add_to_cart" style="background-color: #4AC959;"><i class="fab fa-whatsapp" style="font-weight: bold;"></i> {{__('Pesan') }}</button>
                </div>
                </form>
            </div>
            
            </div>
        </div>
    
        <script type='text/javascript'>
            function button_minus(id)
            {
                var jumlah = $('#jmlbrg_'+id).val();
                var jumlah = parseInt(jumlah) - 1;
                
                // AMBIL NILAI HARGA
                var harga = $('#harga'+id).val();;
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
    
                if (jumlah<0) {
                alert('Jumlah Tidak Boleh Kurang dari nol')
                } else {
                $('#'+id).val(jumlah);
                $('#show_'+id).html(jumlah);
                //$('#productPrice'+id).text(harga);
                }
            }
    
            function button_plus(id)
            {
                var jumlah = $('#jmlbrg_'+id).val();
                var jumlah = parseInt(jumlah) + 1;
                
                
    
                // AMBIL NILAI HARGA
                var harga = $('#harga'+id).val();;
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
                if (jumlah < 0) {
                alert('Jumlah Tidak Boleh kurang dari nol')
                } else {
                $('#'+id).val(jumlah)
                $('#show_'+id).html(jumlah)
                //$('#productPrice'+id).text(harga);
                }
            }
            
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
    
                if (jumlah<0) {
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
        
@endsection
