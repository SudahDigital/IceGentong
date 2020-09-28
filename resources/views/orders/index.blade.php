@extends('layouts.master')
@section('title') Order List @endsection
@section('content')
@if(session('status'))
	<div class="alert alert-success">
		{{session('status')}}
	</div>
@endif

<form action="{{route('products.index')}}">
	<div class="row">
		<!--
		<div class="col-md-3">
			<div class="input-group input-group-sm">
        		<div class="form-line">
	            	<input type="text" class="form-control" name="keyword" value="{{Request::get('keyword')}}" placeholder="Filter by product name" autocomplete="off" />
	    		</div>
	        </div>
		</div>
		<div class="col-md-2">
			<input type="submit" class="btn bg-blue pull-left" value="Filter">
		</div>
		
		<div class="col-md-4">
			<ul class="nav nav-tabs tab-col-pink pull-left" >
				<li role="presentation" class="{{Request::get('status') == NULL && Request::path() == 'products' ? 'active' : ''}}">
					<a href="{{route('products.index')}}" aria-expanded="true" >All</a>
				</li>
				<li role="presentation" class="{{Request::get('status') == 'publish' ?'active' : '' }}">
					<a href="{{route('products.index', ['status' =>'publish'])}}" >PUBLISH</a>
				</li>
				<li role="presentation" class="{{Request::get('status') == 'draft' ?'active' : '' }}">
					<a href="{{route('products.index', ['status' =>'draft'])}}">DRAFT</a>
				</li>
				<li role="presentation" class="">
					<a href="{{route('products.trash')}}" >TRUSH</a>
				</li>
			</ul>
		</div>
		-->
		<div class="col-md-12">
			<a href="{{route('products.create')}}" class="btn btn-success pull-right">Create Product</a>
		</div>
		
	</div>
</form>	

<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover dataTable js-basic-example">
		<thead>
			<tr>
				<th>No</th>
				<th>Invoice number</th>
				<th>Status</th>
				<th>Buyer</th>
				<th>Total quantity</th>
				<th>Order date</th>
				<th>Total price</th>
				<th width="20%">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=0;?>
			@foreach($orders as $order)
			<?php $no++;?>
			<tr>
				<td>{{$no}}</td>
				<td>{{$order->invoice_number}}</td>
				<td>
					@if($order->status == "SUBMIT")
					<span class="badge bg-warning text-light">{{$order->status}}</span>
					@elseif($order->status == "PROCESS")
					<span class="badge bg-info text-light">{{$order->status}}</span>
					@elseif($order->status == "FINISH")
					<span class="badge bg-success text-light">{{$order->status}}</span>
					@elseif($order->status == "CANCEL")
					<span class="badge bg-dark text-light">{{$order->status}}</span>
					@endif
				</td>
				<td>{{$order->user->name}} <br>
					<small>{{$order->user->email}}</small>
				</td>
				<td>{{$order->totalQuantity}} pc (s)</td>
				<td>{{$order->created_at}}</td>
				<td>{{number_format($order->total_price)}}</td>
				
				<td>
					<a class="btn btn-info btn-xs" href="{{route('orders.edit',[$order->id])}}"><i class="material-icons">edit</i></a>&nbsp;
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</div>

@endsection