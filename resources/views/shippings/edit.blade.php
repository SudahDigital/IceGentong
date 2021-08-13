@extends('layouts.master')
@section('title') Edit Shipping Cost @endsection
@section('content')

	@if(session('status'))
		<div class="alert alert-success">
			{{session('status')}}
		</div>
	@endif
	<!-- Form Create -->
    <form id="form_validation" method="POST" enctype="multipart/form-data" action="{{route('shippings.update',[$shipping->id])}}">
    	@csrf
        <input type="hidden" name="_method" value="PUT">
        <h2 class="card-inside-title">Set City</h2>
        <!-- <select name="cities"  id="cities" class="form-control"></select> -->
        <div class="form-line">
            <input type="text" name="cities" class="form-control" value="{{ ($shipping->city!='') ? $city->city_name : 'Nasional'  }}" disabled>
        </div>
        <h2 class="card-inside-title">Set Cost</h2>
        <div class="form-group">
            <input type="radio" value="ON" name="status" id="ON" onclick="set_cost(this.value);" <?php if($shipping->set_cost == 'ON') { echo 'checked'; } ?>>
            <label for="ON">ON</label>
            &nbsp;
            <input type="radio" value="OFF" name="status" id="OFF" onclick="set_cost(this.value);" <?php if($shipping->set_cost == 'OFF') { echo 'checked'; } ?>>
            <label for="OFF">OFF</label>
        </div>
        <div class="form-group form-float" id="form_name" style="<?php if($shipping->set_cost == 'OFF') { echo 'display: none;'; } ?>"> 
            <div class="form-line">
                <input type="text" class="form-control" value="{{$shipping->price}}" name="price" autocomplete="off" required>
                <label class="form-label">Price</label>
            </div>
        </div>

        <button class="btn btn-primary waves-effect" type="submit">EDIT</button>&nbsp;
        <a href="{{route('shippings.index')}}" class="btn bg-deep-orange waves-effect" >&nbsp;CLOSE&nbsp;</a>
    </form>

    <!-- #END#  -->		

@endsection

@section('footer-scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    /*$('#cities').select2({
      placeholder: 'Select an item',
      ajax: {
        url: '{{URL::to('/ajax/cities/search')}}',
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
                  return {
                        id: item.id,
                        text: item.city_name
                      
                  }
              })
          };
        }
        
      }
    });

    var cities = {!! $shipping->city !!}
    cities.forEach(function(cities){
    var option = new Option(cities.city_name, cities.id, true, true);
    $('#cities').append(option).trigger('change');
    });*/
</script>

@endsection