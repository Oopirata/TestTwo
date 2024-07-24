@extends('main')

@section('title', 'Login')

@section('page')
<div class="login-page">
    <div class="login-main">  	
    	 <div class="login-head">
				<h1>Login</h1>
			</div>
			<div class="login-block">
				@if (session('error'))
				<div class="alert alert-danger">
					{{ session('error') }}
				</div>
				@endif
				<form action="/login" method="POST">
					@csrf
					<input class="form-control" type="text" name="username" placeholder="Username" required value="{{ old('username') }}" autofocus>
					<input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
					<input type="submit" name="Sign In" value="Login">	
				</form>
				<h5><a href="/">Go Back to Logs</a></h5>
			</div>
      </div>
</div>
<!--inner block end here-->

<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<script src="{{ asset('js/app.js') }}"></script>
<!-- mother grid end here-->
@endsection