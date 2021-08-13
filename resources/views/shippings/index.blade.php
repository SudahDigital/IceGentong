@extends('layouts.master')
@section('title') Shipping Cost @endsection
@section('content')

@if(session('status'))
	<div class="alert alert-success">
		{{session('status')}}
	</div>
@endif

<form action="{{route('categories.index')}}">
	<div class="row">
		<!--
		<div class="col-md-4">
			<div class="input-group input-group-sm">
        		<div class="form-line">
				<input type="text" class="form-control" name="name" value="{{Request::get('name')}}"  placeholder="Filter berdasarkan nama" autocomplete="off" />
	    		</div>
				<span class="input-group-addon">
					<input type="submit" class="btn bg-blue" value="Filter">
				</span>
			</div>
		</div>
		-->
		<div class="col-md-4">
			<ul class="nav nav-tabs tab-col-pink pull-left" >
				<li role="presentation" class="active">
					<a href="{{route('shippings.index')}}" aria-expanded="true" >All</a>
				</li>
				<!-- <li role="presentation" class="">
					<a href="{{route('categories.trash')}}" >TRUSH</a>
				</li> -->
			</ul>
		</div>		
		<div class="col-md-8">
			<a href="{{route('shippings.create')}}" class="btn btn-success pull-right">Create Shipping Cost</a>
		</div>
	</div>
</form>
<hr>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover dataTable js-basic-example">
		<thead>
			<tr>
				<th>City</th>
				<th>Price</th>
				<th>Set Cost</th>
				<th width="20%">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=0;?>
			@foreach($shipping as $c)
			<?php $no++;?>
			<tr>
				<td>@if($c->city_name !='') 
						{{ $c->city_name }}
					@else 
						Nasional
					@endif</td>
				<td>{{$c->price}}</td>
				<td>{{$c->set_cost}}</td>
				<td>
					<a class="btn btn-info btn-xs" href="{{route('shippings.edit',[$c->id])}}"><i class="material-icons">edit</i></a>&nbsp;
					@if($c->city !='') 
						<button type="button" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#deleteModal{{$c->id}}"><i class="material-icons">delete</i></button>&nbsp;
					@endif 
					<!-- <button type="button" class="btn bg-grey waves-effect" data-toggle="modal" data-target="#detailModal{{$c->id}}">Detail</button> -->

					<!-- Modal Delete -->
		            <div class="modal fade" id="deleteModal{{$c->id}}" tabindex="-1" role="dialog">
		                <div class="modal-dialog modal-sm" role="document">
		                    <div class="modal-content modal-col-red">
		                        <div class="modal-header">
		                            <h4 class="modal-title" id="deleteModalLabel">Delete Shipping Cost</h4>
		                        </div>
		                        <div class="modal-body">
		                           Delete this Shipping Cost ..? 
		                        </div>
		                        <div class="modal-footer">
		                        	<form action="{{route('shippings.delete',[$c->id])}}" method="GET">
										@csrf
										<input type="hidden" name="_method" value="DELETE">
										<button type="submit" class="btn btn-link waves-effect">Delete</button>
										<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Close</button>
									</form>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
	
</div>
@endsection