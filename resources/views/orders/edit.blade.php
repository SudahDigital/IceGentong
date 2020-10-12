@extends('layouts.master')
@section('title') Edit Order @endsection
@section('content')

	@if(session('status'))
		<div class="alert alert-success">
			{{session('status')}}
		</div>
	@endif
	<!-- Form Create -->
    <form id="form_validation" method="POST" action="{{route('orders.update', [$order->id])}}">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group form-float">
            <div class="form-line">
                <label class="form-label">Invoice number</label>
                <input type="text" class="form-control" autocomplete="off" value="{{$order->invoice_number}}" disabled>
            </div>
        </div>

        <div class="form-group form-float">
            <div class="form-line">
                <label class="form-label">Buyer</label>
                <input type="text" class="form-control" autocomplete="off" value="{{$order->username}}" disabled>
            </div>
        </div>

        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control"  autocomplete="off"  value="{{$order->created_at}}" disabled>
                <label class="form-label">Order date</label>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Products ({{$order->totalQuantity}})</label>
            <ul>
                @foreach($order->products as $p)
                <li>{{$p->description}} <b>({{$p->pivot->quantity}})</b></li>
                @endforeach
            </ul>
        </div>
        <br>   
        <br>
        <div class="form-group">
            <div class="form-line">
                <input type="text" class="form-control"  autocomplete="off"  value="{{$order->total_price}}" disabled>
                <label class="form-label">Total Price</label>
            </div>
        </div>

        <label class="form-label">Status</label>
        <div class="form-group">
            <input type="radio" value="SUBMIT" name="status" id="SUBMIT" {{$order->status == 'SUBMIT' ? 'checked' : ''}}>
            <label for="SUBMIT">SUBMIT</label>
            &nbsp;
            <input type="radio" value="PROCESS" name="status" id="PROCESS" {{$order->status == 'PROCESS' ? 'checked' : ''}}>
            <label for="PROCESS">PROCESS</label>
            &nbsp;
            <input type="radio" value="FINISH" name="status" id="FINISH" {{$order->status == 'FINISH' ? 'checked' : ''}}>
            <label for="FINISH">FINISH</label>
            &nbsp;
            <input type="radio" value="CANCEL" name="status" id="CANCEL" {{$order->status == 'CANCEL' ? 'checked' : ''}}>
            <label for="CANCEL">CANCEL</label>
        </div>

        <input type="submit" class="btn btn-primary waves-effect" value="UPDATE">
        
    </form>
    <!-- #END#  -->		

@endsection

