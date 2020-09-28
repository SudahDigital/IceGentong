@extends('template-cart')
@section('content')
            <div class="container" style="margin-top: 30px;">
                <div class="row align-middle">
                    <div class="col-sm-12 col-md-12">
                        <nav aria-label="breadcrumb" class="">
                            <ol class="breadcrumb px-0 button_breadcrumb">
                                <li class="breadcrumb-item" style="color: #4db849 !important;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Keranjang Belanja</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- <hr class="mb-5"> -->
                <form method="post" action="{{route('cart_pay')}}"> <!-- method="post" action="{{route('cart_pay')}}" -->
                @csrf
                <div class="row section_content mb-5" style="margin-bottom: 30px">
                    <div class="col-sm-12 col-md-4 col-md-4 mb-5">
                        <div class="card mx-auto cart_card">
                            <div class="card-body">
                                    <div class="form-group">
                                        <input style="border:1px solid #4CD31E" type="text" required="true" name="costumer_name" class="form-control" placeholder="Nama" id="name"required autofocus autocomplete="off">
                                        <!-- <label for="name" class="cart_label">Nama</label> -->
                                    </div>
                                    <div class="form-group">
                                        <textarea style="border:1px solid #4CD31E" class="form-control" required="true"  name="costumer_adress" rows="5" placeholder="Alamat Pengiriman" id="deliveryAddress" required autocomplete="off"></textarea>
                                        <!-- <label for="deliveryAddress" class="cart_label">Alamat Pengiriman</label> -->
                                    </div>  
                                    <div class="form-group">
                                        <input style="border:1px solid #4CD31E" type="number"  name="costumer_phone" required="true" class="form-control" placeholder="Nomor Telepon" id="phoneNumber" required autocomplete="off">
                                        <!-- <label for="phoneNumber" class="cart_label">Nomor Telepon</label> -->
                                    </div>
                                    <div class="form-group">
                                        <input style="border:1px solid #4CD31E" type="email" required="true"  name="costumer_email" class="form-control" placeholder="Email" id="email" required autocomplete="off">
                                        <!-- <label for="email" class="cart_label">Email</label> -->
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8 mb-6">
                        <div class="card mx-auto cart_card">
                            <div class="card-body table-responsive">
                                <table class="table text-nowrap" style="width: 100%;">
                                    <tbody>
                                        @php
                                         $total = 0 ;
                                         $total_pay = 0 ;
                                         $total_brg = 0 ;
                                         $nm_brg = '';
                                        @endphp
                                        @foreach($cart as $key => $value)
                                        @php
                                        $amount = $value->product_harga * $value->mount;
                                        $total += $amount;
                                        $total_brg = count($cart);
                                        $total_pay += $amount;
                                        $nm_brg .= $value->product_name." (".$value->mount."),";

                                        @endphp
                                        <tr>
                                            <td class="align-middle img-product" scope="row">
                                                <img src="{{ asset('assets/image/product/'.(($value->image_link!='') ? $value->image_link : '20200621_184223_0016.jpg').'') }}" class="card-img-top img-fluid">
                                            </td>
                                            <td class="align-middle">
                                                <h5 class="product-name" style="color: #4db849 !important; font-weight: bold;">{{$value->product_name}}</h5>
                                                <p id="mount3_{{$value->id}}" style="color: #000 !important;">Rp {{ number_format($amount, 0, ',', '.') }}</p>
                                                <div>
                                                    <button type="button" class="btn btn-success button_minus" onclick="cart_minus('{{$value->id}}')" style="padding: 0; text-align: center;">-</button>
                                                    <span class="mr-1 ml-1" id="show_m3{{$value->id}}">{{$value->mount}}</span>
                                                    <button type="button" class="btn btn-success button_plus" onclick="cart_plus('{{$value->id}}')" style="padding: 0; text-align: center;">+</button>
                                                    <input type="hidden" id="{{$value->id}}" value="{{$value->mount}}">
                                                    <input type="hidden" id="harga_m{{$value->id}}" value="{{$amount}}">
                                                    <input type="hidden" id="harga{{$value->id}}" value="{{$value->product_harga}}">
                                                    <input type="hidden" id="total_brg" value="{{$total_brg}}">
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <a class="btn btn-sm btn-danger" href="{{route('cart_delete',$value->id)}}" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang belanja Anda?');"><i class="fa fa-times"></i></a>
                                                <!-- <a class="btn btn-sm btn-danger" onclick="char_tes('{{$value->id}}')"><i class="fa fa-times" style="color: white;"></i></a> -->
                                            </td>
                                        </tr>
                                        @endforeach
                                        @php
                                            $all_brg    = substr($nm_brg, 0, strlen($nm_brg) -1);
                                        @endphp
                                        <input type="hidden" name="total_pay" id="total_pay" value="{{$total_pay}}">
                                        <input type="hidden" id="nm_brg" value="{{$all_brg}}">
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer" id="whatsapp">
                                <button onclick="whatsapp();" class="btn btn-success btn-block button_order">Pesan Sekarang</button>
                            </div>
                            <!-- <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-block button_order">
                                    Pesan Sekarang
                                </button>
                            </div> -->
                        </div>
                    </div>
                </div>
                </form>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script type="text/javascript">
                function whatsapp(){
                    var nm      = $('#name').val();
                    var almt    = $('#deliveryAddress').val(); 
                    var tlp     = $('#phoneNumber').val();
                    var email   = $('#email').val();
                    var total_brg = $('#total_brg').val();
                    var total_pay = $('#total_pay').val();
                    var nm_brg    = $('#nm_brg').val();

                    if(nm!='' && almt!='' && tlp!='' && email!='' && total_brg!=''){
                        window.open('https://api.whatsapp.com/send?phone=+6281212610009&text=*Nama*:%20'+nm+'%0A*Alamat*:%20'+almt+'%0A*Telp*:%20'+tlp+'%0A*Email*:%20'+email+'%0A*Total Item*:%20'+total_brg+'%0A*Total Harga*:%20'+total_pay+'%0A*Pesanan*:%20'+nm_brg);
                    }else{
                        Swal.fire({ text: 'Silahkan isi data terlebih dahulu!', confirmButtonColor: '#4db849'});
                    }

                    /*Swal.fire({
                      text: "Pemesanan akan diteruskan ke Whatsapp ?",
                      showCancelButton: true,
                      confirmButtonColor: '#4db849',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Lanjutkan',
                      cancelButtonText: "Batal"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.open('https://api.whatsapp.com/send?phone=+6281776492873&text=Nama: '+nm+' Alamat: '+almt+' Telp: '+tlp+' Email: '+email+' Total: '+total_pay);
                      }
                    });*/
                }
            </script>



@endsection
