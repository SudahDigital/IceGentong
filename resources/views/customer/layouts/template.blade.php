<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Ice-Gentong</title>

    <link rel="icon" href="{{ asset('assets/image/logo-nav.png')}}" type="image/png" sizes="16x16">
    <!-- Bootstrap CSS CDN -->
    <link href="//db.onlinewebfonts.com/c/3dd6e9888191722420f62dd54664bc94?family=Myriad+Pro" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"
      integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V"
      crossorigin="anonymous"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KLCTDZT');</script>
    <!-- End Google Tag Manager -->
    <style type="text/css">
        .preloader{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
        }

        .preloader .loading {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            font: 14px arial;
        }
    </style>
    <script>
        $(document).ready(function(){
          $(".preloader").fadeOut();
        })
    </script>
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KLCTDZT"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="preloader" id="preloader">
        <div class="loading">
          <img src="{{ asset('assets/image/preload.gif') }}" width="80">
          <p style="font-weight:900;line-height:2;color:#6a3137;margin-left: -10%;">Harap Tunggu</p>
        </div>
    </div>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header mx-auto">
                <a href="{{url('/') }}">
                    <img src="{{ asset('assets/image/ecim-gentong.png') }}" width="70%" height="auto" class="d-inline-block align-top" alt="" loading="lazy">
                </a>
            </div>
            <ul class="list-unstyled components">
                <li class="">
                   <a href="{{ url('/') }}">Beranda</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Produk</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        @foreach($categories as $key => $value)
                            <li>
                                <a href="{{route('category.index', ['id'=>$value->id] )}}" style="font-size: 1.1em !important;">{{$value->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                   <a href="{{URL::route('cara_belanja')}}">Cara Berbelanja</a>
                </li>
                <li>
                    <a href="{{URL::route('contact')}}">Kontak Kami</a>
                </li>
            </ul>
            <div class="mx-auto text-center" style="margin-top: 35px;">
                <div class="social-icons">
                    <a href="https://www.facebook.com/Gentongicecream/"  target="_blank"><i class="fab fa-facebook" ></i></a>
                    <a href="https://instagram.com/gentongicecream?igshid=10b120fidnx58"  target="_blank"><i class="fab fa-instagram "></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="https://twitter.com/kedaigentong?s=08" target="_blank"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </nav>
        <!--content-->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="z-index: 1.5;">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn button-burger-menu">
                        <i class="fas fa-bars fa-2x" style="color:#693234;"></i>
                    </button>
                   
                    <a class="navbar-brand nav-center" href="{{ url('/') }}">
                        <img src="{{ asset('assets/image/ecim-gentong.png') }}" class="p-0 m-0 d-inline-block align-top" alt="" loading="lazy">
                    </a>
                    <form action="{{route('search.index')}}" class="form-inline my-2 my-lg-0 ml-auto d-none d-md-inline-block">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn  my-2 my-sm-0 search_botton_navbar" type="submit" id="button-search-addon" style="border-radius: 50%;"><i class="fa fa-search"></i></button>&nbsp;&nbsp;&nbsp;
                            </div>
                            <input class="form-control d-inline-block m-100 search_input_navbar" name="keyword" type="text" value="{{Request::get('keyword')}}" placeholder="Search" aria-label="Search" aria-describedby="button-search-addon">
                              
                        </div>
                    </form>
                    <a href="#searh_responsive" class="btn btn-info d-md-none" data-toggle="modal" data-target="#searchModal" style="border-radius: 50%; background:#693234;; border:none;"><i class="fa fa-search" style=""></i></a>
                </div>
            </nav>
            <!-- BANNER -->
            <div role="main" style="margin-top: 5rem;">
                <div id="bannerSlide" class="carousel slide" data-ride="carousel" >
                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/image/banner-min.png') }}" class="w-100 h-100">
                        </div>
                    </div>
                </div>
            </div>    
               
            @yield('content')

        </div>
    </div>
    
    <div class="overlay"></div>

    <!-- Modal search -->
    <div class="modal fade" id="searchModal" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content" style="background: #FDD8AF">
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <form action="{{route('search.index')}}">
                            <div class="input-group">
                                <div class="input-group-append">
                                        <button class="btn search_botton_navbar" type="submit" id="button-search-addon" style="border-radius: 50%;"><i class="fa fa-search"></i></button>
                                        <input class="form-control d-block search_input_navbar" name="keyword" type="text" value="{{Request::get('keyword')}}" placeholder="Search" aria-label="Search" aria-describedby="button-search-addon">
                                </div>
                                    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>-->
    <script type="text/javascript">
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#dismiss, .overlay').on('click', function () {
            $('#sidebar').removeClass('active');
            $('.overlay').removeClass('active');
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').addClass('active');
            $('.overlay').addClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });

        function pesan_wa()
        {
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

            harga = "Rp. " + rupiah;

            if (jumlah < 0) {
                alert('Jumlah Tidak Boleh Kurang dari nol');
                }
                else 
                {
                    $('#jmlbrg_'+id).val(jumlah);
                    $('#show_'+id).text(jumlah);
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
                            //$('#'+id).val(jumlah);
                            //$('#show_'+id).html(jumlah);
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

            harga = "Rp. " + rupiah;
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
                    success: function (data){
                        console.log(data);
                        //$('#'+id).val(jumlah);
                        //$('#show_'+id).html(jumlah);
                        //$('#productPrice'+id).text(harga);

                        $.ajax({
                            url : '{{URL::to('/home_cart')}}',
                            type : 'GET',
                            success: function (response) {
                            // We get the element having id of display_info and put the response inside it
                            $('#accordion' ).html(response);
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

            harga = "Rp. " + rupiah;

            if (jumlah<1) {
            alert('Jumlah order minimal 1')
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
                var id_detil = $('#id_detil'+id).val();
                var order_id = $('#order_id'+id).val();
                var price = $('#harga_kr'+id).val();
                var tot =  parseInt($('#total_kr_val').val()) - parseInt($('#harga_kr'+id).val());
                var tot_val = tot;
                var	number_string = tot.toString();
                var sisa 	= number_string.length % 3;
                var rupiah 	= number_string.substr(0, sisa);
                var ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
                }

                tot = "Rp. " + rupiah;
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
                                $('#quantity_delete'+id).val(jumlah);
                                $('#total_kr_').html(tot);
                                $('#total_kr_val').val(tot_val);
                            $.ajax({
                                    url : '{{URL::to('/home_cart')}}',
                                    type : 'GET',
                                    success: function (response) {
                                    // We get the element having id of display_info and put the response inside it
                                    //$( '#accordion' ).html(response);
                                    //$('#collapse-4').addClass('show');
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
            var harga = $('#harga_kr'+id).val();
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

            harga = "Rp. " + rupiah;
            
            // alert(jumlah)
            if (jumlah < 1) {
            alert('Jumlah order minimal 1')
            } 
            else 
            {
                $('#jmlbrg_'+id).val(jumlah);
                $('#show_'+id).html(jumlah);
                $('#jmlkr_'+id).val(jumlah);
                $('#show_kr_'+id).html(jumlah);
                $('#productPrice_kr'+id).text(harga);
                //$('#totalKr_'+id).text(totalkr);
                var id_detil = $('#id_detil'+id).val();
                var order_id = $('#order_id'+id).val();
                var price = $('#harga_kr'+id).val();
                var tot = parseInt($('#harga_kr'+id).val()) + parseInt($('#total_kr_val').val());
                var tot_val = tot;
                var	number_string = tot.toString();
                var sisa 	= number_string.length % 3;
                var rupiah 	= number_string.substr(0, sisa);
                var ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
                }

                tot = "Rp. " + rupiah;
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
                                $('#quantity_delete'+id).val(jumlah);
                                $('#total_kr_').html(tot);
                                $('#total_kr_val').val(tot_val);
                                $.ajax({
                                    url : '{{URL::to('/home_cart')}}',
                                    type : 'GET',
                                    success: function (response) {
                                    // We get the element having id of display_info and put the response inside it
                                    //$( '#accordion').html(response);
                                    //$('#collapse-4').addClass('show');
                                    }
                                });
                            },
                            error: function (data) {
                            console.log('Error:', data);
                            }
                        });
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
                    //$('#'+id).val(jumlah);
                    $('#jmlbrg_'+id).val(jumlah);
                    $('#show_'+id).html(jumlah);
                    //$('#productPrice'+id).text(harga);
                        $.ajax({
                            url : '{{URL::to('/home_cart')}}',
                            type : 'GET',
                            success: function (response) {
                            // We get the element having id of display_info and put the response inside it
                            $( '#accordion' ).html(response);
                            $('#collapse-4').addClass('show');
                            }
                        });
                    },
                    error: function (data) {
                    console.log('Error:', data);
                    }
            });
        }

        $(document).ready(function() {  
            $('#btn-yes').on('click', function(){
                var id_modal = $("#modal-input-id").val();
                Swal.fire('Yes!');
            });
        });
    
        window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
        }, 4000);

        //analytics
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-Q5EG4YYH5S');
    </script>
</body>

</html>