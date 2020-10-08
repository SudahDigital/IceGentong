@extends('customer.layouts.template-nocart')
@section('content')
    <div class="container" style="margin-top: 80px;">
        <div class="row align-middle">
            <div class="col-sm-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb px-0 button_breadcrumb cr_bl">
                        <li class="breadcrumb-item" style="color: #6a3137 !important;margin-top:30px;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="margin-top:30px;">Cara Berbelanja</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>    
        <div class="card mx-auto cara_belanja">
            <div id="cara-belanja">
                <div class="row card-body">
                
                    <div class="col-6 col-md-2 ">
                        <img src="{{asset('assets/image/cari-produk.png')}}" class="card-img-top"  alt="...">
                    </div>
                    <div class="col-6 col-md-4 card-img-top">
                        <h5 class="card-title">1. Cari Produk</h5>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</p>
                    </div>

                    <div class="col-6 col-md-2 card-img-top">
                        <img src="{{asset('assets/image/keranjang.png')}}" class="card-img-top"  alt="...">
                    </div>
                    <div class="col-6 col-md-4 card-img-top">
                        <h5 class="card-title">2. Masukkan Dalam Keranjang Belanja</h5>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</p>
                    </div>

                    <div class="col-6 col-md-2 card-img-top">
                        <img src="{{asset('assets/image/isi-data.png')}}" class="card-img-top"  alt="...">
                    </div>
                    <div class="col-6 col-md-4 card-img-top">
                        <h5 class="card-title">3. Isi Data</h5>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</p>
                    </div>

                    <div class="col-6 col-md-2 card-img-top">
                        <img src="{{asset('assets/image/confirm-wa.png')}}" class="card-img-top"  alt="..." >
                    </div>
                    <div class="col-6 col-md-4 card-img-top">
                        <h5 class="card-title">4. Konfirmasi Via  Whatsapp</h5>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</p>
                    </div>
               
                
                </div>
            </div>
            
        </div>
            
        
        
    
@endsection
