<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sign In | Mypett Insurance</title>
    <link href="{{ asset('landing/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('landing/login/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('landing/vendor/font-awesome/css/main.css') }}" rel="stylesheet" />
</head>
<body>
<div class="container d-flex flex-wrap" id="container">
    <div class="form-container sign-up-container col-sm-12">
        <form method="POST" action="{{ route('sign-in.member') }}">
            @csrf
            <h3>Create Account</h3>
            <span>or use your email for registration</span>
            @if(session()->has('regisError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-lock fs-4 text-black"></i>
                    {{ session('regisError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <input type="text" name="name" id="reg-name" required value="" placeholder="Name">
            <input type="email" name="email" id="reg-email" required value="" placeholder="email">
            <input type="password" name="password" id="reg-password" required value="" placeholder="Passowrd">
            <input type="password" name="confirmpassword" id="reg-confirmpassword" required value="" placeholder="Re-Password">
            <button type="submit" class="mt-5">Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container col-sm-12">
        <form method="POST" action="{{ route('register.member') }}">
            @csrf
            <h3>Sign in</h3>
            <span  class="mb-3">or use your account</span>
            @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-lock fs-4 text-black"></i>
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session()->has('regError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-lock fs-4 text-black"></i>
                    {{ session('regError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <input type="text" name="email" id="login-email" required value="{{ old('email') }}" placeholder="email">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <input type="password" name="password" id="login-password" required value="{{ old('password') }}" placeholder="password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <a href="{{ asset('views/indexs.php') }}">Forgot your password?</a>
            <button type="submit" class="mt-5">Sign In</button>
        </form>
    </div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<img src="{{ asset('img/mypet.png') }}" style="width: 300px; height: 300px;" alt="">
				<button class="ghost mt-1" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
            <img src="{{ asset('img/mypet.png') }}" style="width: 300px; height: 300px;" alt="">
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('landing/js/bootstrap.js') }}"></script>
<script src="{{ asset('landing/login/login.js') }}"></script>
<script>
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container');

	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});

	signInButton.addEventListener('click', () => {
		container.classList.remove("right-panel-active");
	});
</script>
</body>
</html>








