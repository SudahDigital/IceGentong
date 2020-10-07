@extends('customer.layouts.template')
@section('content')
    @if($product->count() <= 3)
    <div class="">
    @else
    <div class="warna">
    @endif
        <div class="container" style="margin-top:30px;">
            <div class="row align-middle" style="margin-bottom: 20px">
                <div class="col-sm-12">
                    
                    <div class="col-md-12 mx-auto">
                        <table width="100%" style="margin-bottom: 20px;">
                        <tbody>
                            <tr>
                                <td class="menu-filter">
                                    
                                        @if($product->count() <= 3)
                                        <h3 class="cat_fil" style="color: #693234;">
                                            Filter Category 
                                        </h3>
                                        @else
                                        <h3 class="cat_fil" style="color: #ffffff; ">
                                            Filter Category 
                                        </h3>
                                        @endif
                                    
                                </td>
                                <td width="60%" align="left">
                                    @if($product->count() <= 3)
                                        <button type="button" class="btn" data-toggle="collapse" data-target="#demo" style="background-color:#FDD8AF; border:none;">
                                            <i class="fas fa-sliders-h tombol" style="color:#693234"></i>
                                        </button>
                                    @else
                                    <button type="button" class="btn" data-toggle="collapse" data-target="#demo" style="background-color:#693234; border:none;">
                                        <i class="fas fa-sliders-h tombol" style="color:#fff;"></i>
                                    </button>
                                    @endif
                                </td>
                                
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    
                    <div id="demo" class="collapse" style="">
                        <div class="col-md-12" style="margin-bottom: 20px;">
                        <a href="{{url('/')}}" type="button" class="btn button_add_to_cart button-collapse">Semua Produk</a>
                        @foreach($kategori as $key => $value)
                            <a href="{{route('category_user.index', ['id'=>$value->id] )}}" type="button" class="btn button_add_to_cart button-collapse">{{$value->name}}</a>
                        @endforeach
                        </div>
                    </div> 
                    
                
                </div>
               
                <br>
                <div class="col-md-12">
                    <div class="row section_content">
                  
                        @foreach($product as $key => $value)
                         <div class="col-6 col-lg-4">
     
                             <div class="card mx-auto item_product">
                                 <a href="{{URL::route('product_detail', ['id'=>$value->id])}}">
                                     <img style="" src="{{ asset('storage/'.(($value->image!='') ? $value->image : '20200621_184223_0016.jpg').'') }}" class="img-fluid h-150 w-100 img-responsive" alt="...">
                                 </a>
                                 
                                     <div class="float-left px-1 py-2" style="width: 100%;">
                                         <p class="product-price-header mb-0" style="">
                                             {{$value->description}}
                                         </p>
                                     </div>
                                     <div class="float-left px-1 py-2" style="">
                                         <p class="product-price mb-0" id="productPrice{{$value->id}}" style="">Rp {{ number_format($value->price, 0, ',', '.') }}</p>
                                     </div>
                                     
                                     
                                     <table width="100%" class="hdr_tbl_cart">
                                         <tbody>
                                         <tr>
                                             <!--
                                             <td class="tbl_cart"  valign="middle" style="">
                                                 
                                             </td>
                                             -->
                                             
                                            <form method="post" action="{{ route('customer.keranjang.simpan') }}" id="myform">
                                                @csrf
                                                @if(\Auth::user())
                                                    @auth
                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    @endauth
                                                @endif
                                                
                                                
                                                <input type="hidden" name="Product_id" value="{{$value->id}}">
                                                <!--<button class="btn btn-block button_add_to_cart respon" style="">Tambah</button>-->
                                            
                                             <td width="10%" align="right" valign="middle">
                                                 <a class="button_minus" onclick="button_minus('{{$value->id}}')" style=""><i class="fa fa-minus" aria-hidden="true"></i></a>
                                             </td>
                                             <td width="10%" align="center" valign="middle">
                                                 <p id="show_{{$value->id}}" class="d-inline show" style="">0</p>
                                                 <input type="hidden" id="{{$value->id}}" name="quantity" value="0">
                                                 <input type="hidden" id="harga{{$value->id}}" name="price" value="{{ $value->price }}">
                                             </td>
                                             <td width="10%" align="left" valign="middle">
                                                
                                                 <a href="javascript: submit();" class="button_plus" onclick="button_plus('{{$value->id}}')" style=""><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                
                                             </td>
                                            </form>
                                         </tr>
                                         </tbody>
                                     </table>
                                     
                                 
                             </div>
     
                         </div>
                         @endforeach
                            
                     <div class="row justify-content-md-center mx-auto" >
                         <div style="margin-top:-7rem; margin-bottom:7rem;">{{ $product->links('vendor.pagination.bootstrap-4') }}</div>
                     </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- Footer section -->
    <footer id="footer">
                
        <div class="container">

           <div class="row justify-content-center mx-auto" >
                <img src="{{ asset('assets/image/logo-nav.png') }}" width="55%" height="auto">
            </div>
            <br><br>
            <div class="row justify-content-center mx-auto" >    
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram "></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-twitter "></i></a>
                </div>
            </div>
                <div class="copyright text-center">
                    <p>@Copyright 2020</p>
                </div>
                
        </div>
        
    </footer>

    <div id="accordion">
        <div class="card fixed-bottom" style="">
            <div id="card-cart" class="card-header" >
                <table width="100%" style="margin-bottom: 40px;">
                    <tbody>
                        <tr>
                            <td width="5%" valign="middle">
                                <div id="ex4">
                               
                                    <span class="p1 fa-stack fa-2x has-badge" data-count="0">
                                
                                        <!--<i class="p2 fa fa-circle fa-stack-2x"></i>-->
                                        <i class="fa fa-shopping-cart" data-count="4b" style=""></i>
                                    </span>
                                </div> 
                            </td>
                            <td width="25%" align="left" valign="middle">
                                <h5>Rp.</h5>
                            </td>
                            <td width="5%" valign="middle" >
                            <a id="cv" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4" class="collapsed">
                                    <i  class="fas fa-chevron-up " style=""></i>
                                </a>
                            </td>
                            <td width="33%" align="right" valign="middle">
                               
                                <h5>(0 Item)</h5>
                               
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="collapse-4" class="collapse" data-parent="#accordion"  >
                <div class="card-body" >
                    <table width="100%" style="margin-bottom: 40px;">
                        <tbody>
                            <tr>
                                <td width="5%" valign="middle">
                                     
                                </td>
                                <td width="25%" align="left" valign="middle">
                                   
                                </td>
                                <td width="5%" valign="middle" >
                                
                                </td>
                                <td width="33%" align="right" valign="middle">
                                  
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript'>
        function submit()
         {
            document.forms["myform"].submit();
         }
    </script>
@endsection
