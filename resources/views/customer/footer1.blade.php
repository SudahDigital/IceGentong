
            <footer class="footer fixed-bottom">
                <div class="row">
                    <div class="col-5 col-sm-4 my-auto" id="sosmed">
                        <!-- <a href="https://api.whatsapp.com/send?phone=&text=Halo" class="float-left mr-1 mr-md-3"> -->
                            <a href="https://api.whatsapp.com/send?phone=+6281776492873&text=Halo" class="float-left mr-1 mr-md-3">
                                <img src="{{ asset('assets/image/whatsapp_logo.png') }}" alt="" class="img-fluid" style="width: 30px;">
                            </a>
                            <a href="https://www.instagram.com/orideli.id/" class="float-left mr-1 mr-md-3">
                                <img src="{{ asset('assets/image/instagram_logo.png') }}" alt="" class="img-fluid" style="width: 30px;">
                            </a>
                            <a href="https://facebook.com/" class="float-left mr-1 mr-md-3">
                                <img src="{{ asset('assets/image/facebook_logo.png') }}" alt="" class="img-fluid" style="width: 30px;">
                            </a>
                        </div>
                        <div id="tombol_click" class="col-2">
                            <a href="#" id="clickme" class=" align-self-center" isi="true" style="color: #008000 !important">
                                <i class="fas fa-chevron-circle-up"></i>
                            </a>
                        </div>
                        <div class="col-5 col-sm-4 my-auto" id="cart_icon">
                            <?php
                                if(!empty($cart)) {
                                    $total = 0;
                                    foreach($cart as $key => $value) {
                                        $amount = $value->product_harga * $value->mount;
                                        $total += $amount;
                                    }
                                
                            ?>
                                <div>
                                    <p class="float-right" style="color: #fff; line-height: 50px;"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></p>
                                </div>
                                <a href="#" class="float-right cart" style="position: relative;">
                                    <?php
                                        if($count_cart < 10) {
                                    ?>
                                        <p class="count-cart-one">{{ $count_cart }}</p>
                                        <img src="{{ asset('assets/image/bucket.png') }}" alt="" class="img-fluid" style="width: 45px;">
                                    <?php
                                        }  elseif($count_cart < 100) {
                                    ?>
                                        <p class="count-cart-two">{{ $count_cart }}</p>
                                        <img src="{{ asset('assets/image/bucket.png') }}" alt="" class="img-fluid" style="width: 45px;">
                                    <?php
                                        } else {
                                    ?>
                                        <p class="count-cart-three">{{ $count_cart }}</p>
                                        <img src="{{ asset('assets/image/bucket2.png') }}" alt="" class="img-fluid" style="width: 45px;">
                                    <?php
                                        } 
                                    ?>
                                </a>    
                            <?php
                                } else {
                            ?>
                                <p class="float-right p-0 my-auto" style="color: #fff;"><strong>Rp 0</strong></p>
                                <a href="{{route('cart')}}" class="float-right mr-1 mr-md-3 cart" style="position: relative;">
                                    <p class="count-cart-one">{{ $count_cart }}</p>
                                    <img src="{{ asset('assets/image/bucket.png') }}" alt="" class="img-fluid" style="width: 60px;">
                                </a>
                                {{-- <button type="button" class="btn btn-success button-pesan mb-0 float-right mr-3" data-toggle="modal" data-target="#modalCheckout">Pesan</button> --}}
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="hidden row" id="book">
                        <div class="scroll w-100 h-100" id="table_c" style="display: none;">
                            @php
                             $total = 0 ;
                            @endphp
                            @foreach($cart as $key => $value)
                            @php
                            $amount = $value->product_harga * $value->mount;
                            $total += $amount;
                            @endphp
                            <div class="row">
                                <div class="col-4">
                                    <div class="float-left">
                                        <img class="img-thumbnail img-fluid" src="{{ asset('assets/image/product/'.(($value->image_link!='') ? $value->image_link : '20200621_184223_0016.jpg').'') }}" style="max-width: 100px;max-height: 100px;" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="float-left">
                                        <h5 class="product-name" style="color: #4db849 !important; font-weight: bold;">{{$value->product_name}}</h5>
                                        <span id="mount2_{{$value->id}}" style="color: #000 !important;">Rp {{ number_format($amount, 0, ',', '.') }}</span>
                                        <div class="text-left">
                                            <button type="button" class="btn btn-success button_minus" onclick="cart('{{$value->id}}','min')" style="padding: 0; text-align: center;">-</button>
                                            <span class="mr-1 ml-1" id="show_m2{{$value->id}}"> {{$value->mount}} </span>
                                            <button type="button" class="btn btn-success button_plus" onclick="cart('{{$value->id}}','plus')" style="padding: 0; text-align: center;">+</button>
                                            <input type="hidden" id="{{$value->id}}" value="{{$value->mount}}">
                                            <input type="hidden" id="harga_m{{$value->id}}" value="{{$amount}}">
                                            <input type="hidden" id="harga{{$value->id}}" value="{{$value->product_harga}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <!-- <a class="btn btn-sm btn-danger" href="{{route('cart_delete',$value->id)}}" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang belanja Anda?');"><i class="fa fa-times"></i></a> -->
                                    <a class="btn btn-sm btn-danger" onclick="valDel('{{$value->id}}')"><i class="fa fa-times" style="color: white;"></i></a>
                                </div>
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-12">
                                    <div class="float-left">
                                        <span style="background: #ffffff;font-size: 250%">&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="proses_to_chart_slide w-100"  style="background-color: white;">
                            {{ $count_cart }} Item | <span id="total_">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            <a href="{{route('cart')}}" class="btn btn-success align-self-right btn-sm">
                            <i class="fa fa-shopping-basket ml-1"></i>
                            <input type="hidden" id="total" value="{{$total}}">
                            Pesan Sekarang
                            </a>                                
                        </div>
                    </div>
            </footer>
