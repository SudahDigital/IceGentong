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
		
		<div class="col-md-12">
			<a href="{{route('products.create')}}" class="btn btn-success pull-right">Create Product</a>
		</div>
		-->
	</div>
</form>	

<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover dataTable js-basic-example">
		<thead>
			<tr>
				<th>No</th>
				<th>Status</th>
				<th width="30%">Buyer</th>
				<th width="20%" style="padding-left: 5%;">Order Product</th>
				<th>Total quantity</th>
				<th>Order date</th>
				<th>Total price</th>
				<th width="5%">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=0;?>
			@foreach($orders as $order)
			<?php $no++;?>
			<tr>
				<td>{{$no}}</td>
				<td>
					@if($order->status == "SUBMIT")
					<span class="badge bg-deep-orange text-light">{{$order->status}}</span>
					@elseif($order->status == "PROCESS")
					<span class="badge bg-blue text-light">{{$order->status}}</span>
					@elseif($order->status == "FINISH")
					<span class="badge bg-green text-light">{{$order->status}}</span>
					@elseif($order->status == "CANCEL")
					<span class="badge bg-black text-light">{{$order->status}}</span>
					@endif
				</td>
				<td><small><b>Name :</b> {{$order->username}}</small><br>
					<small><b>Email :</b> {{$order->email}}</small><br>
					<small><b>Addr :</b> {{$order->address}}</small><br>
					<small><b>Phone :</b> {{$order->phone}}</small>
				</td>
				<td align="left">
					<ul style="margin-left: 0;">
						@foreach($order->products as $p)
						<li><small>{{$p->description}} <b>({{$p->pivot->quantity}})</b></small></li>
						@endforeach
					</ul>
				</td>
				<td>{{$order->totalQuantity}} pc (s)</td>
				<td>{{$order->created_at}}</td>
				<td>{{number_format($order->total_price)}}</td>
				
				<td>
					<a class="btn btn-info btn-xs btn-block" href="{{route('orders.detail',[$order->id])}}">Details</a>&nbsp;
					<a style="margin-top:0;" class="btn btn-success btn-xs btn-block" href="{{route('order_edit',[$order->id])}}">Edit</a>&nbsp;
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</div>

@endsection
