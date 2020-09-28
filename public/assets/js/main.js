// detail product

// $('.button_minus').on('click',function(){
//         var jumlah = $('[name="jumlah"]').val();
//        	var jumlah = parseInt(jumlah) - 1;
//        	// alert(jumlah)
//        	if (jumlah<1) {
//        		alert('Jumlah Tidak Boleh Kosong')
//        	}else{
//        		$('[name="jumlah"]').val(jumlah)
//        		$('#jumlah').html(jumlah)
//        	}
// });

// $('.button_plus').on('click',function(){
//         var jumlah = $('[name="jumlah"]').val();
//        	var jumlah = parseInt(jumlah) + 1;
//        	// alert(jumlah)
//        	if (jumlah<1) {
//        		alert('Jumlah Tidak Boleh Kosong')
//        	}else{
//        		$('#jumlah').html(jumlah)
//        		$('[name="jumlah"]').val(jumlah)
//        	}
// });


// list product

function button_minus(id)
{
    var jumlah = $('#'+id).val();
    var jumlah = parseInt(jumlah) - 1;

    // AMBIL NILAI HARGA
    var harga = $('#harga'+id).val();;
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

    if (jumlah<1) {
      alert('Jumlah Tidak Boleh Kosong')
    } else {
      $('#'+id).val(jumlah);
      $('#show_'+id).html(jumlah);
      $('#productPrice'+id).text(harga);
    }
}

function button_plus(id)
{
    var jumlah = $('#'+id).val();
    var jumlah = parseInt(jumlah) + 1;

    // AMBIL NILAI HARGA
    var harga = $('#harga'+id).val();;
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
    if (jumlah<1) {
      alert('Jumlah Tidak Boleh Kosong')
    } else {
      $('#'+id).val(jumlah)
      $('#show_'+id).html(jumlah)
      $('#productPrice'+id).text(harga);
    }
}

function button_minus_detail(id)
{
    var jumlah = $('#'+id).val();
    var jumlah = parseInt(jumlah) - 1;

    // AMBIL NILAI HARGA
    var harga = $('#harga'+id).val();;
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

    if (jumlah<1) {
      alert('Jumlah Tidak Boleh Kosong')
    }else{
      $('#'+id).val(jumlah)
      $('#show_detail_'+id).html(jumlah)

      $('#productPrice'+id).text(harga);
    }
}

function button_plus_detail(id)
{
  var jumlah = $('#'+id).val();
  var jumlah = parseInt(jumlah) + 1;

  // AMBIL NILAI HARGA
  var harga = $('#harga'+id).val();;
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
  if (jumlah<1) {
    alert('Jumlah Tidak Boleh Kosong')
  } else {
    $('#'+id).val(jumlah);
    $('#show_detail_'+id).html(jumlah);

    $('#productPrice'+id).text(harga);
  }
}

// cart

function cart(id,param)
{
  var harga_mount = $('#harga_m'+id).val();
  var harga = $('#harga'+id).val();
  var total = $('#total').val();
  var mount = $('#'+id).val();
  var mount_plus = parseInt(mount)+1;
  var mount_min  = parseInt(mount)-1;

  if(param=='plus'){
    $.ajax({
      url: '/cart/update_mount?id='+id+'&mount='+mount+'&type='+param,
      success : function(data){
        if (data=='success') {
          var mount1 = parseInt(mount)+1;
          var harga_mount1 = parseInt(harga_mount) + parseInt(harga);
          harga_mount2 = rupiah(harga_mount1);

          $('#show_m2'+id).html(mount1);
          $('#'+id).val(mount1);

          $('#harga_m'+id).val(harga_mount1);
          $('#mount2_'+id).html(harga_mount2);
          var total1 = parseInt(total)+ parseInt(harga);

          $('#total').val(total1);
          var total2 = rupiah(total1);
          $('#total_').html(total2);
        }
      }
    })
  }

  if(param=='min'){
    if(mount_min!='0'){
      $.ajax({
        url: '/cart/update_mount?id='+id+'&mount='+mount+'&type='+param,
        success : function(data){
          if (data=='success') {
            var mount1 = parseInt(mount)-1;
            var harga_mount1 = parseInt(harga_mount) - parseInt(harga);
            harga_mount2 = rupiah(harga_mount1);
            
            $('#show_m2'+id).html(mount1);
            $('#'+id).val(mount1);

            $('#harga_m'+id).val(harga_mount1);
            $('#mount2_'+id).html(harga_mount2);
            var total1 = parseInt(total)- parseInt(harga);

            $('#total').val(total1);
            var total2 = rupiah(total1);
            $('#total_').html(total2);
          }
        }
      })
    }
  }

  /*$.ajax({
    url: '/cart/update_mount?id='+id+'&mount='+mount+'&type='+param,
    success : function(data){
      if (data=='success') {
        if (param=='plus') {
          // console.log(id)
          var mount1 = parseInt(mount)+1;
          // var mount1 = mount1.toString();
          $('#show_m2'+id).html(mount1);
          $('#'+id).val(mount1);
          var harga_mount1 = parseInt(harga_mount) + parseInt(harga);
          harga_mount2 = rupiah(harga_mount1);
          $('#harga_m'+id).val(harga_mount1);
          $('#mount2_'+id).html(harga_mount2);
          var total1 = parseInt(total)+ parseInt(harga);

          $('#total').val(total1);
          var total2 = rupiah(total1);
          $('#total_').html(total2);

        }else{
          var mount1 = parseInt(mount)-1;
          // var mount1 = mount1.toString();
          var harga_mount1 = parseInt(harga_mount) - parseInt(harga);
          harga_mount2 = rupiah(harga_mount1);

          if (mount1<1) {
            alert('Jumlah Tidak Boleh Kosong');
          }else{  
            $('#show_m2'+id).html(mount1);
            $('#'+id).val(mount1);

            $('#harga_m'+id).val(harga_mount1);
            $('#mount2_'+id).html(harga_mount2);
            var total1 = parseInt(total)- parseInt(harga);

            $('#total').val(total1);
            var total2 = rupiah(total1);
            $('#total_').html(total2);
          }
        }
      }
    }
  })*/
  // location.reload();
}


function cart_minus(id)
{
    var jumlah = $('#'+id).val();
    var jumlah = parseInt(jumlah) - 1;

    // AMBIL NILAI HARGA
    var harga = $('#harga'+id).val();;
    var harga = parseInt(harga) * jumlah;

    // UBAH FORMAT UANG INDONESIA
    var number_string = harga.toString();
    var sisa  = number_string.length % 3;
    var rupiah  = number_string.substr(0, sisa);
    var ribuan  = number_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    harga = "Rp " + rupiah;

    if (jumlah<1) {
      alert('Jumlah Tidak Boleh Kosong')
    } else {
      $('#'+id).val(jumlah);
      $('#show_m3'+id).html(jumlah);
      $('#mount3_'+id).html(harga);
    }
}

function cart_plus(id)
{
    var jumlah = $('#'+id).val();
    var jumlah = parseInt(jumlah) + 1;

    // AMBIL NILAI HARGA
    var harga = $('#harga'+id).val();;
    var harga = parseInt(harga) * jumlah;

    // UBAH FORMAT UANG INDONESIA
    var number_string = harga.toString();
    var sisa  = number_string.length % 3;
    var rupiah  = number_string.substr(0, sisa);
    var ribuan  = number_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    harga = "Rp " + rupiah;
    
    // alert(jumlah)
    if (jumlah<1) {
      alert('Jumlah Tidak Boleh Kosong')
    } else {
      $('#'+id).val(jumlah)
      $('#show_m3'+id).html(jumlah)
      $('#mount3_'+id).html(harga);
    }
}


function rupiah(bilangan)
{
  var number_string = bilangan.toString(),
  sisa  = number_string.length % 3,
  rupiah  = number_string.substr(0, sisa),
  ribuan  = number_string.substr(sisa).match(/\d{3}/g);
    
  if (ribuan) {
    separator = sisa ? ',' : '';
    rupiah += separator + ribuan.join(',');
  }
   hasil = 'RP '+rupiah
  return hasil;
}





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

            $(document).ready(function(){
                $(".button_add_to_cart").click(function(){                  
                  $("#totalBottomFixed").removeClass("d-none");
                  $("#totalBottomFixed").addClass("d-inline-block");
                });
            });

        $( "#clickme" ).click(function() {
            var isi = $("#clickme").attr('isi');
            // alert(isi)
          $( "#book" ).slideDown( "slow", function() {
            if (isi=='true') {
                    $('#tombol_click').removeClass();
                    $('#tombol_click').addClass('col-12');
                    $('#table_c').css({'display':'block'});
                    $('.proses_to_chart_slide').css({'display':'block'});
                    $('#clickme').html('<i class="fas fa-chevron-circle-down"></i>');
                    $('#clickme').attr('isi','false');
                    $('#cart_icon').css({'display':'none'})
                    $('#sosmed').css({'display':'none'})
                    $('.hidden').toggleClass('open');

            }else{
                    $('#tombol_click').removeClass();
                    $('#tombol_click').addClass('col-1');
                    $('.proses_to_chart_slide').css({'display':'none'});
                    $('#clickme').html('<i class="fas fa-chevron-circle-up"></i>');
                    $('#clickme').attr('isi','true');
                    $('#cart_icon').css({'display':'block'})
                    $('#sosmed').css({'display':'block'})
                    $('.hidden').toggleClass('open');
                    $('#table_c').css({'display':'none'});
            }
          });
        });
