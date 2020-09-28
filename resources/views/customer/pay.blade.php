@extends('template-cart')
@section('content')
            <div class="container" style="margin-top: 20px;">
                <div class="row align-middle">
                    <div class="col-sm-12 col-md-6 order-2 order-md-1">
                        <h3 class="title-page">Preview Order</h3>
                    </div>
                    <div class="col-sm-12 col-md-6 order-1 order-md-2">
                        <nav aria-label="breadcrumb" class="">
                            <ol class="breadcrumb float-right px-0 button_breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Preview Order</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <hr class="mb-5">
                <div class="row section_content">
                    <div class="col-sm-12 col-md-4 mb-5">
                        <div class="card mx-auto cart_card">
                            <div class="card-body">
                                    <div class="form-group">
                                        <input type="text"  readonly="true" value="{{$address['name']}}" required="true" name="costumer_name" class="form-control cart_input" placeholder="Name" id="name"required autofocus autocomplete="off">
                                        <label for="name" class="cart_label">Name</label>
                                    </div>
                                    <div class="form-group">
                                        <textarea readonly="true" class="form-control cart_input" required="true" name="costumer_adress" rows="5" placeholder="Delivery Address" id="deliveryAddress" required autocomplete="off">{{$address['adress']}}</textarea>
                                        <label for="deliveryAddress" class="cart_label">Delivery Address</label>
                                    </div>  
                                    <div class="form-group">
                                        <input type="number"  readonly="true" value="{{$address['phone']}}"  name="costumer_phone" required="true" class="form-control cart_input" placeholder="Phone Number" id="phoneNumber" required autocomplete="off">
                                        <label for="phoneNumber" class="cart_label">Phone Number</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="email"  readonly="true" value="{{$address['email']}}" required="true"  name="costumer_email" class="form-control cart_input" placeholder="Email" id="email" required autocomplete="off">
                                        <label for="email" class="cart_label">Email</label>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8 mb-5">
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
                                        $total += $amount;
                                        @endphp
                                        <tr>
                                            <td class="align-middle w-25" scope="row">
                                                <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/medium//92/MTA-7130791/gudang_sayur_gudang_sayur_-_sayur_pakchoy_-_pokchoy_-pok_choi_full01_tfvby22m.jpg?output-format=webp" class="card-img-top img-fluid">
                                            </td>
                                            <td class="align-middle">
                                                <p><b>{{$value->product_name}}</b></p>
                                                <p>
                                                    
                                                    <span id="show_m{{$value->id}}">{{$value->mount}} <b>X</b></span>
                                                    <span>RP {{number_format($value->product_harga)}}</span>
                                                </p >
                                            </td>
                                            <td class="align-middle" id="mount_{{$value->id}}">Rp {{number_format($amount)}}</td>
                                        </tr>
                                        @endforeach
                                        <tr>{{$total}}</tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2">Total</th>
                                            <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
                                            <input type="hidden" id="total" value="{{$total}}">
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button id="pay-button" type="button" class="btn btn-success btn-block button_order">
                                    PAY
                                </button>
                                 <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-2B_D09_iE8q1cxYn"></script>
                                <script type="text/javascript">
                                  document.getElementById('pay-button').onclick = function(){
                                    // SnapToken acquired from previous step
                                    snap.pay('{{$snapToken}}', {
                                      // Optional
                                      onSuccess: function(result){
                                        /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                      },
                                      // Optional
                                      onPending: function(result){
                                        /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                      },
                                      // Optional
                                      onError: function(result){
                                        /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                      }
                                    });
                                  };
                                </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
