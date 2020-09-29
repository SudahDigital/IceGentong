<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style type="text/css">
            .hidden {
                margin-top: 0px;
                height: 0px;
                -webkit-transition: height 0.5s linear;
                   -moz-transition: height 0.5s linear;
                    -ms-transition: height 0.5s linear;
                     -o-transition: height 0.5s linear;
                        transition: height 0.5s linear;
            }
    
            .hidden.open {
                 height: 500px;
                 -webkit-transition: height 0.5s linear;
                    -moz-transition: height 0.5s linear;
                     -ms-transition: height 0.5s linear;
                      -o-transition: height 0.5s linear;
                         transition: height 0.5s linear;
            }
            .scroll { 
                    /*height: 500px; */
                    overflow-x: hidden; 
                    overflow-y: auto; 
                    text-align:justify; 
                } 
            .proses_to_chart_slide{
                position:fixed;
                bottom: 10px;
                padding: 10px;
                display: none;
            }
            @media screen and (max-width: 600px) {
                .nav-center {
                    position: absolute;
                    left: 40%;
                }
            }
            @media screen and (min-width: 768px) {
                .nav-center {
                    position: absolute;
                    left: 45%;
                }
            }
    
            @media screen and (min-width: 1920px) {
                .nav-center {
                    position: absolute;
                    left: 50%;
                }
            }
        </style>
    
    </head>
<body>
     @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $message }}</strong>
      </div>
    @endif

    <div class="wrapper">

        <!-- Sidebar  -->
        <nav id="sidebar">
           
            <div class="sidebar-header mx-auto">
                <a href="{{ url('/') }}">
                    <img src="{{asset('assets/image/logo-nav.png')}}" width="70%" height="auto" class="d-inline-block align-top" alt="" loading="lazy">
                </a>
            </div>
            <ul class="list-unstyled components">
                <form class="d-md-none d-block px-3" action="">
                    <div class="input-group mb-4">
                        <input class="form-control text-center" type="search" name="keyword" placeholder="Search" aria-label="Search" aria-describedby="button-addon">
                        <!--<div class="input-group-append">
                            <button class="btn btn-ligth search-sidebar" type="submit" id="button-addon"><i class="fa fa-search"></i></button>
                        </div>-->
                    </div>
                </form>
                <li class="active">
                    <a href="{{ url('/') }}">Beranda</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Produk</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                       
                    </ul>
                </li>
                <li>
                    <a href="{{URL::route('cara_belanja')}}">Cara Berbelanja</a>
                </li>
                <li>
                    <a href="{{URL::route('contact')}}">Kontak Kami</a>
                </li>
            </ul>

            <div class="mx-auto text-center">
                <a href="{{route('login')}}" class="btn login">Sign In</a>
            </div>
                    
            <div class="mx-auto text-center">  
                    <a href="{{route('register')}}" class="register">Sign Up</a>
            </div> 
            
            <div class="mx-auto text-center" style="margin-top: 35px;">
                <div class="social-icons">
                    <a href="#"><i class="fa fa-facebook" ></i></a>
                    <a href="#"><i class="fa fa-instagram "></i></a>
                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                    <a href="#"><i class="fa fa-twitter "></i></a>
                </div>
            </div>

        </nav>

        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="z-index: 1.5;">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn button-burger-menu">
                        <i class="fa fa-bars fa-2x" style="color:#693234;"></i>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}" style="position: absolute; left:45%;" >
                        <img src="{{ asset('assets/image/logo-nav.png') }}" width="120px" height="auto" class="p-0 m-0 d-inline-block align-top" alt="" loading="lazy" style="left: 70%;">
                    </a>
                    <form action="" class="form-inline my-2 my-lg-0 ml-auto d-none d-md-inline-block">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn  my-2 my-sm-0 search_botton_navbar" type="submit" id="button-search-addon" style="border-radius: 50%;"><i class="fa fa-search"></i></button>&nbsp;&nbsp;&nbsp;
                            </div>
                            <input class="form-control d-inline-block m-100 search_input_navbar" name="keyword" type="text"  placeholder="Search" aria-label="Search" aria-describedby="button-search-addon">
                              
                        </div>
                    </form>
                </div>
            </nav>

            <!-- Page Content  -->
            @yield('content')

        </div>
       
    </div>
    <div class="overlay"></div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        $(document).ready(function() {  
            /*$('#edit-modal').on('show.bs.modal', function() {
                var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
                var row = el.closest(".data-row");

                // get the data
                var id = el.data('item-id');
                var name = row.children(".name").text();
                var description = row.children(".description").text();

                // fill the data in the input fields
                $("#modal-input-id").val(id);
                $("#modal-input-name").val(name);
                $("#modal-input-description").val(description);

            }) */

            $('#btn-yes').on('click', function(){
                var id_modal = $("#modal-input-id").val();
                Swal.fire('Yes!');
            });
        });

        function valDel(id){
            // $('#edit-modal').modal('show');
            Swal.fire({
              title: 'Hapus barang ?',
              text: "Item ini akan di hapus dari keranjangmu",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#4db849',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Hapus',
              cancelButtonText: "Batal"
            }).then((result) => {
              if (result.isConfirmed) {

                $.ajax({
                    type: "GET",
                    url: "{{url('/cart/delete')}}"+'/'+id,
                    data: {id:id},
                    success: function (data) {
                        Swal.fire({
                           title: 'Sukses',
                           text: 'Item ini berhasil di hapus',
                           icon: 'success'}).then(function(){ 
                        location.reload();
                        });
                    }         
                });
              }
              
            });
        }
       
    </script>
</body>

</html>