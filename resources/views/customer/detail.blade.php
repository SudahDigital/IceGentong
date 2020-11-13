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
                                            <input type="hidden" id="Product_id{{$product->id}}" name="Product_id" value="{{$product->id}}">
                                            <input type="hidden" id="quantity_add{{$product->id}}" name="quantity" value="1">
                                            <input type="hidden" id="harga{{$product->id}}" name="price" value="{{$product->price}}">
                                            <button class="btn button_minus" onclick="button_minus('{{$product->id}}')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-minus" aria-hidden="true"></i></button>
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
                                            <button class="btn button_plus" onclick="button_plus('{{$product->id}}')" style="background:none; border:none; color:#693234;outline:none;"><i class="fa fa-plus" aria-hidden="true"></i></button> 
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
                                <h5 id="total_kr_">Rp.
                                    {{number_format($item->total_price , 0, ',', '.')}}</h5>
                                    @else
                                <h5 id="total_kr_">Rp.</h5>
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
                                                
                                                
                                                @if($total_item > 0)
                                                <a type="button" class="btn button_add_to_cart" data-toggle="modal" data-target="#my_modal_content">Beli Sekarang</a>
                                                @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            
                        </div>
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
                        <button type="submit" class="btn button_add_to_cart" onclick="pesan_wa()" style="background-color: #4AC959;"><i class="fab fa-whatsapp" style="font-weight: bold;"></i> {{__('Pesan') }}</button>
                    </div>
                    </form>
                </div>
                
                </div>
            </div>
        </div>
    
        
    
        <script type='text/javascript'>
            function pesan_wa(){
                var name = document.getElementById("name").value;
                var email = document.getElementById("email").value;
                var address = document.getElementById("address").value;
                var phone = document.getElementById("phone").value;
                if (name != "" && email!="" && address !="" && phone !="") {
			        Swal.fire({
                        title: 'Memesan',
                        text: "Anda melakukan pesanan melalui whatsapp",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: "Ok",
                        confirmButtonColor: '#4db849'
                        }).then(function(){ 
                            location.reload();
                        });
                    }else{
                        alert('Anda harus mengisi data dengan lengkap !');
                    }
            }

            
            function delete_kr(id)
            {   
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var quantity_delete = $('#quantity_delete'+id).val();
                    var quantity_delete = parseInt(quantity_delete);
                    var jumlah = $('#jmlbrg_'+id).val();
                    var jumlah = parseInt(jumlah) - quantity_delete;
                    var order_id_delete = $('#order_id_delete'+id).val();
                    var price_delete = $('#price_delete'+id).val();
                    var product_id_delete = $('#product_id_delete'+id).val();
                    var id_delete = $('#id_delete'+id).val();
                    var price = $('#harga'+id).val();
                    $.ajax({
                        url : '{{URL::to('/keranjang/delete')}}',
                        type:'POST',
                        data:{
                            id : id_delete,
                            product_id : product_id_delete,
                            order_id : order_id_delete,
                            quantity : quantity_delete,
                            price : price_delete
                        },              
                        success: function (data) {
                        console.log(data);
                        $('#'+id).val(jumlah);
                        $('#jmlbrg_'+id).val(jumlah);
                        $('#show_'+id).html(jumlah);
                        //$('#productPrice'+id).text(harga);
                            $.ajax({
                                url : '{{URL::to('/home_cart')}}',
                                type : 'GET',
                                success: function (response) {
                                // We get the element having id of display_info and put the response inside it
                                $( '#accordion' ).html(response);
                                }
                            });
                        },
                        error: function (data) {
                        console.log('Error:', data);
                        }
                });
                
            }

            function button_minus(id)
            {   
                var jumlah = $('#jmlbrg_'+id).val();
                var jumlah = parseInt(jumlah) - 1;
                
                // AMBIL NILAI HARGA
                var harga = $('#harga'+id).val();
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

                if (jumlah < 0) {
                    alert('Jumlah Tidak Boleh Kurang dari nol');
                    }
                    else 
                    {
                        $('#jmlbrg_'+id).val(jumlah);
                        $('#show_'+id).html(jumlah);
                        var Product_id = $('#Product_id'+id).val();
                        var quantity = $('#quantity_add'+id).val();
                        var price = $('#harga'+id).val();
                        
                        $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url : '{{URL::to('/keranjang/min_order')}}',
                                type:'POST',
                                data:{
                                    Product_id : Product_id,
                                    quantity : quantity,
                                    price : price
                                },              
                                success: function (data) {
                                console.log(data);
                                $('#'+id).val(jumlah);
                                $('#show_'+id).html(jumlah);
                                //$('#productPrice'+id).text(harga);
                                    $.ajax({
                                        url : '{{URL::to('/home_cart')}}',
                                        type : 'GET',
                                        success: function (response) {
                                        // We get the element having id of display_info and put the response inside it
                                        $( '#accordion' ).html(response);
                                        }
                                    });
                                },
                                error: function (data) {
                                console.log('Error:', data);
                                }
                            });
                }
            }

            function button_plus(id)
            {
                var jumlah = $('#jmlbrg_'+id).val();
                var jumlah = parseInt(jumlah) + 1;
                
                // AMBIL NILAI HARGA
                var harga = $('#harga'+id).val();
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
                } 
                else 
                {
                    $('#jmlbrg_'+id).val(jumlah);
                    $('#show_'+id).html(jumlah);
                    var Product_id = $('#Product_id'+id).val();
                    var quantity = $('#quantity_add'+id).val();
                    var price = $('#harga'+id).val();
                    $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url : '{{URL::to('/keranjang/simpan')}}',
                                type:'POST',
                                data:{
                                    Product_id : Product_id,
                                    quantity : quantity,
                                    price : price
                                },              
                                success: function (data) {
                                console.log(data);
                                $('#'+id).val(jumlah);
                                $('#show_'+id).html(jumlah);
                                $('#productPrice'+id).text(harga);
                                    $.ajax({
                                        url : '{{URL::to('/home_cart')}}',
                                        type : 'GET',
                                        success: function (response) {
                                        // We get the element having id of display_info and put the response inside it
                                        $( '#accordion' ).html(response);
                                        }
                                    });
                                },
                                error: function (data) {
                                console.log('Error:', data);
                                }
                            });

                            
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
                    $('#jmlbrg_'+id).val(jumlah);
                    $('#show_'+id).html(jumlah);
                    $('#jmlkr_'+id).val(jumlah);
                    $('#show_kr_'+id).html(jumlah);
                    $('#productPrice_kr'+id).text(harga);
                    $('#totalKr_'+id).text(totalkr);
                    var id_detil = $('#id_detil'+id).val();
                    var order_id = $('#order_id'+id).val();
                    var price = $('#harga_kr'+id).val();
                
                    $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url : '{{URL::to('/keranjang/kurang')}}',
                                type:'POST',
                                data:{
                                    id_detil : id_detil,
                                    order_id : order_id,
                                    price : price
                                },              
                                success: function (data) {
                                $.ajax({
                                        url : '{{URL::to('/home_cart')}}',
                                        type : 'GET',
                                        success: function (response) {
                                        // We get the element having id of display_info and put the response inside it
                                        $( '#accordion' ).html(response);
                                        }
                                    });
                                },
                                error: function (data) {
                                console.log('Error:', data);
                                }
                            });

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
                if (jumlah < 0) {
                alert('Jumlah Tidak Boleh Kosong')
                } else {
                    $('#jmlbrg_'+id).val(jumlah);
                    $('#show_'+id).html(jumlah);
                    $('#jmlkr_'+id).val(jumlah);
                    $('#show_kr_'+id).html(jumlah);
                    $('#productPrice_kr'+id).text(harga);
                    //$('#totalKr_'+id).text(totalkr);
                    var id_detil = $('#id_detil'+id).val();
                    var order_id = $('#order_id'+id).val();
                    var price = $('#harga_kr'+id).val();
                
                    $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url : '{{URL::to('/keranjang/tambah')}}',
                                type:'POST',
                                data:{
                                    id_detil : id_detil,
                                    order_id : order_id,
                                    price : price
                                },              
                                success: function (data) {
                                $.ajax({
                                        url : '{{URL::to('/home_cart')}}',
                                        type : 'GET',
                                        success: function (response) {
                                        // We get the element having id of display_info and put the response inside it
                                        $( '#accordion' ).html(response);
                                        }
                                    });
                                },
                                error: function (data) {
                                console.log('Error:', data);
                                }
                            });
                }
            }
        </script>
        
@endsection
