@extends('layouts.master')
@section('title') Create User @endsection
@section('content')

	@if(session('status'))
		<div class="alert alert-success">
			{{session('status')}}
		</div>
	@endif
	<!-- Form Create -->
    <form id="form_validation" method="POST" enctype="multipart/form-data" action="{{route('users.store')}}">
    	@csrf
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="name" autocomplete="off" required>
                <label class="form-label">Name</label>
            </div>
        </div>
                                
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="username" autocomplete="off" required>
                <label class="form-label">UserName</label>
            </div>
        </div>
                        
		<h2 class="card-inside-title">Roles</h2>
        <div class="form-group">
            <input type="checkbox" name="roles[]" id="ADMIN" value="ADMIN">
			<label for="ADMIN">Administrator</label>
							&nbsp;
            <input type="checkbox" name="roles[]" id="STAFF" value="STAFF">
			<label for="STAFF">Staff</label>
							&nbsp;
			<input type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER">
			<label for="CUSTOMER">Customer</label>
        </div>

        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="phone" minlength="10" maxlength="12" autocomplete="off" required>
                <label class="form-label">Phone Number</label>
            </div>
            <div class="help-info">Min.10, Max. 12 Characters</div>
        </div>

        <div class="form-group">
            <div class="form-line">
                <textarea name="address" rows="4" class="form-control no-resize" placeholder="Address" autocomplete="off" required></textarea>
            </div>
        </div>

        <h2 class="card-inside-title">Avatar Image</h2>
        <div class="form-group">
         <div class="form-line">
             <input type="file" name="avatar" class="form-control" id="avatar" autocomplete="off">
            </div>
        </div>

        <div class="form-group form-float">
            <div class="form-line">
                <input type="email" class="form-control" name="email" autocomplete="off" required>
                <label class="form-label">Email</label>
            </div>
        </div>

        <div class="form-group form-float">
            <div class="form-line">
                <input type="password" class="form-control" name="password" required>
                <label class="form-label">Password</label>
            </div>
        </div>

        <div class="form-group form-float">
            <div class="form-line">
                <input type="password" class="form-control" name="password_confirmation" required>
                <label class="form-label">Password Confirmation</label>
            </div>
        </div>
                        
        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
    </form>
    <!-- #END#  -->		

@endsection