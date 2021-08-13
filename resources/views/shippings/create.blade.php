@extends('layouts.master')
@section('title') Create Shipping Cost @endsection
@section('content')

	@if(session('status'))
		<div class="alert alert-success">
			{{session('status')}}
		</div>
	@endif
	<!-- Form Create -->
    <form id="form_validation" method="POST" enctype="multipart/form-data" action="{{route('shippings.store')}}">
    	@csrf
        <h2 class="card-inside-title">Set City</h2>
        <select name="cities"  id="cities" class="form-control"></select>
        <h2 class="card-inside-title">Set Cost</h2>
        <div class="form-group">
            <input type="radio" value="ON" name="status" id="ON" onclick="set_cost(this.value);">
            <label for="ON">ON</label>
            &nbsp;
            <input type="radio" value="OFF" name="status" id="OFF" onclick="set_cost(this.value);">
            <label for="OFF">OFF</label>
        </div>
        <div class="form-group form-float" id="form_name"> 
            <div class="form-line">
                <input type="text" class="form-control" name="price" autocomplete="off" required>
                <label class="form-label">Price</label>
            </div>
        </div>

        <button class="btn btn-primary waves-effect" type="submit">SAVE</button>
    </form>
    <!-- #END#  -->		

@endsection

@section('footer-scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $('#cities').select2({
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
    </script>

@endsection