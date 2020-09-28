@extends('template-cart')
@section('content')
            <div class="container" id="shoppingCart" style="margin-top: 70px;">
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
                <form method="post" action="{{route('cart_pay')}}">
                @csrf
                <div class="row section_content">
                    {{-- <div class="col-sm-12 col-md-4 mb-5">
                        <form method="post" action="{{route('order')}}">
                            @csrf
                            <div class="card mx-auto cart_card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="text" required="true" name="costumer_name" class="form-control cart_input" placeholder="Nama" id="name"required autofocus autocomplete="off">
                                        <label for="name" class="cart_label">Nama</label>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control cart_input" required="true"  name="costumer_adress" rows="5" placeholder="Alamat Pengiriman1" id="deliveryAddress" required autocomplete="off"></textarea>
                                        <label for="deliveryAddress" class="cart_label">Alamat Pengiriman</label>
                                    </div>  
                                    <div class="form-group">
                                        <input type="number"  name="costumer_phone" required="true" class="form-control cart_input" placeholder="Nomor Telepon" id="phoneNumber" required autocomplete="off">
                                        <label for="phoneNumber" class="cart_label">Nomor Telepon</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" required="true"  name="costumer_email" class="form-control cart_input" placeholder="Email" id="email" required autocomplete="off">
                                        <label for="email" class="cart_label">Email</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> --}}
                    <div class="col-sm-12 col-md-12 mb-5">
                        <div class="card mx-auto cart_card">
                            <div class="card-body table-responsive">
                                <table class="table text-nowrap" style="width: 100%;">
                                    <tbody>
                                        @php
                                         $total = 0 ;
                                        @endphp
                                        @foreach($cart as $key => $value)
                                        @php
                                        $amount = $value->product_harga * $value->mount;
                                        $total += $amount
                                        @endphp
                                        <tr>
                                            <td class="align-middle img-product" scope="row">
                                                <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/medium//92/MTA-7130791/gudang_sayur_gudang_sayur_-_sayur_pakchoy_-_pokchoy_-pok_choi_full01_tfvby22m.jpg?output-format=webp" class="card-img-top img-fluid">
                                            </td>
                                            <td class="align-middle">
                                                <h5 class="product-name" style="color: #4db849 !important; font-weight: bold;">{{$value->product_name}}</h5>
                                                <p id="mount_{{$value->id}}" style="color: #000 !important;">Rp {{ number_format($amount, 0, ',', '.') }}</p>
                                                <div>
                                                    <button type="button" class="btn btn-success button_minus" onclick="cart_minus('{{$value->id}}')" style="padding: 0; text-align: center;">-</button>
                                                    <span class="mr-1 ml-1" id="show_m{{$value->id}}">{{$value->mount}}</span>
                                                    <button type="button" class="btn btn-success button_plus" onclick="cart_plus('{{$value->id}}')" style="padding: 0; text-align: center;">+</button>
                                                    <input type="hidden" id="{{$value->id}}" value="{{$value->mount}}">
                                                    <input type="hidden" id="harga_m{{$value->id}}" value="{{$amount}}">
                                                    <input type="hidden" id="harga{{$value->id}}" value="{{$value->product_harga}}">
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <a class="btn btn-sm btn-danger" href="{{route('cart_delete',$value->id)}}" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang belanja Anda?');"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br>
        </div>

@endsection
