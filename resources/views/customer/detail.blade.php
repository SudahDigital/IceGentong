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
                                    <tr><!--
                                        <td class="tbl_cart" valign="middle" style="">
                                        </td>-->
                                        <!--<button class="btn btn-block button_add_to_cart respon" style="">Tambah</button>-->
                                        <td width="10%" align="right" valign="middle">
                                             <a class="button_minus" onclick="button_minus('{{$product->id}}')" style=""><i class="fa fa-minus" aria-hidden="true"></i></a>
                                        </td>
                                        <td width="10%" align="center" valign="middle">
                                             <p id="show_{{$product->id}}" class="d-inline show" style="">0</p>
                                        </td>
                                        <td width="10%" align="left" valign="middle">
                                            <form method="post" action="{{ route('customer.keranjang.simpan') }}">
                                                @csrf
                                                @if(Route::has('login'))
                                                    @auth
                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    @endauth
                                                @endif
                                                <input type="hidden" name="Product_id" value="{{$product->id}}">
                                                <input type="hidden" id="{{$product->id}}" name="quantity" value="1">
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
                            <table width="100%" style="margin-bottom: 40px; ">
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
                                        <td width="15%" align="left" valign="top" style="padding-top: 5%;">
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
                                </tbody>
                            </table>
                            <div class="mx-auto text-right">
                                @if($item!==null)    
                                    <div id="bt_beli">
                                        <?php $href = 'Hello Saya Ingin Membeli %3A%0A';?>
                                        @foreach($keranjang as $detil)
                                        @php 
                                            $href.='*'.$detil->description.'%20(Qty %3A%20'.$detil->quantity.')%0A';
                                        @endphp
                                        @endforeach
                                        <a target="_BLANK" href="https://wa.me/6282113464465?text=<?php echo $href; ?>"
                                        class="btn">Beli Sekarang</a>
                                    </div>
                                @endif
                            </div>
                            
                        </div>
                    </div>
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
        
@endsection
