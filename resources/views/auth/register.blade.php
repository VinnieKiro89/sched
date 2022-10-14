<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Register</title>
	<!-- Bootstrap 4.1.1 -->
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center" style="margin-top:45px">
			<div class="col-md-4 col-md-offset-4">
				<h4>Register</h4><hr>
				<form action="{{ route('auth.save') }}" method="post">

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session()->has('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('fail') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @csrf
                    <div class="form-group">
						<label>Full Name</label>
						<input type="text" class="form-control" name="fname" placeholder="Enter Full Name Here" value="{{ old('fname') }}">
                        <span class="text-danger">@error('fname'){{ $message }} @enderror</span>
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" name="username" placeholder="Enter Username Here" value="{{ old('username') }}">
                        <span class="text-danger">@error('username'){{ $message }} @enderror</span>
					</div>
					<div class="form-group">
						<select class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" name="level" required autofocus>

							<option value="" selected disabled hidden>Enter Role:</option>
							<option value="1st Year">1.	Academic Head</option>
							<option value="2nd Year">2. Faculty</option>
							<option value="3rd Year">3. Director</option>
							<option value="4th Year">4. Admin</option>

						</select>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password" placeholder="Enter password Here">
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
					</div>
					<button type="submit" class="btn btn-block btn-primary">Sign Up</button>
					<br>
					<a href="{{ route('auth.login') }}">I already have an account</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>