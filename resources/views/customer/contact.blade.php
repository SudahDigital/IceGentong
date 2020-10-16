@extends('customer.layouts.template-nocart')
@section('content')
    <div class="container" style="margin-top:80px;">
        <div class="row align-middle">
            <div class="col-sm-12 col-md-12">
                <nav aria-label="breadcrumb" class="">
                    <ol class="breadcrumb px-0 button_breadcrumb kontak">
                        <li class="breadcrumb-item" style="color: #6a3137 !important;margin-top:30px; font-size:20px;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="margin-top:30px;">Kontak Kami</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row section_content">
            <div class="col-sm-12 mb-5">
                <!-- <form>
                    <div class="card mx-auto contact_card">
                        <div class="card-body"> -->
                            <!-- <div class="form-group">
                                <input style="border:1px solid #4CD31E" type="text" class="form-control" placeholder="Nama" id="name "required autofocus autocomplete="off"> -->
                                <!-- <label for="name" class="contact_label">Nama</label> -->
                            <!-- </div>
                            <div class="form-group">
                                <input style="border:1px solid #4CD31E" type="email" class="form-control" placeholder="Email" id="email" required autocomplete="off"> -->
                                <!-- <label for="email" class="contact_label">Email</label> -->
                            <!-- </div>
                            <div class="form-group">
                                <input style="border:1px solid #4CD31E" type="text" class="form-control" placeholder="Subject" id="subject" required autocomplete="off"> -->
                                <!-- <label for="subject" class="contact_label">Subjek</label> -->
                            <!-- </div>
                            <div class="form-group">
                                <textarea style="border:1px solid #4CD31E" class="form-control" rows="5" placeholder="Pesan" id="message" required autocomplete="off"></textarea> -->
                                <!-- <label for="message" class="contact_label">Pesan</label> -->
                            <!-- </div>  --> 
                            <!-- <a class="btn btn-block btn-outline-success"><i class="fa fa-envelope"></i>&nbsp;Email</a>
                            <a class="btn btn-block btn-outline-success"><i class="fa fa-phone"></i>&nbsp;Telepon</a> -->
                        <!-- </div>
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-block btn-success button_send">Kirim</button>
                    </div>
                </form> -->
                <div class="row section_content" style="margin-top: 3.8rem;">
                    <div class="col-sm-12 col-md-6">
                        <div class="card mx-auto item_product contact_kami">
                            <div class="row card-body">

                                <div class="col col-md-3">
                                    <i class="fa fa-phone" id="i-kontak"></i>
                                </div>
                                <div class="col col-md-9">
                                    <p class="card-title telp">Telepon</p>
                                    <h5 class="card-title no_telp">‭082311988000‬</h5>
                                </div>
                            <!--
                            <div class="col-12 col-md-6 float-left my-auto d-none d-md-inline-block text-center">
                                <i class="fa fa-envelope fa-5x"></i>
                            </div>
                            <div class="col-12 col-md-6 float-right my-auto text-center">
                                <a class="card-img-top d-md-none d-inline-block fa fa-envelope fa-lg"></a>
                                <h5 class="card-title" style="font-size: 15px">Email</h5>
                                <h5 class="card-title" style="font-size: 15px">email@orideli.com</h5>
                            </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="card mx-auto item_product contact_kami">
                            <div class="row card-body">

                                <div class="col col-md-3">
                                    <i class="fa fa-envelope" id="i-envelop"></i>
                                </div>
                                <div class="col col-md-9">
                                    <p class="card-title" id="env">Email</p>
                                    <h5 class="card-title" id="e_env">yardizhen@gmail.com</h5>
                                </div>
                            
                            <!--
                            <div class="col-12 col-md-6 float-left my-auto d-none d-md-inline-block text-center">
                                <i class="fa fa-phone fa-5x"></i>
                            </div>
                            <div class="col-12 col-md-6 float-right my-auto text-center">
                                <a class="card-img-top d-md-none d-inline-block fa fa-phone fa-lg"></a>
                                <h5 class="card-title" style="font-size: 15px">Telepon</h5>
                                <h5 class="card-title" style="font-size: 15px">0812xxxxxxxx</h5>
                            </div>-->
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>
@endsection
