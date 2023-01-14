<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Sign In | Mypett Insurance</title>
    <link href="{{ asset('landing/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('landing/login/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('landing/vendor/font-awesome/css/main.css') }}" rel="stylesheet" />
</head>
<body>
<div class="container d-flex flex-wrap" id="container">
    <div class="form-container sign-up-container col-sm-12">
        <form id="up">
            <h3>Create Account</h3>
            <span>or use your email for registration</span>
            <input type="text" name="name" id="reg-name" required placeholder="Name">
            <input type="email" name="email" id="reg-email" required placeholder="email">
            <input type="password" name="password" id="reg-password" required placeholder="Passowrd">
            <input type="password" name="confirmpassword" id="reg-confirmpassword" required placeholder="Re-Password">
            <button type="submit" class="mt-5 signup">Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container col-sm-12">
        <form id="in">
            <h3>Sign in</h3>
            <span  class="mb-3">or use your account</span>
            <div class="invalid_message"></div>
            <input type="text" name="email" id="email" required placeholder="email">
            <small class="text-danger email_error" style="font-size: 12px;"></small>
            <input type="password" name="password" id="password" required placeholder="password">
            <small class="text-danger password_error" style="font-size: 12px;"></small>
            <a href="#">Forgot your password?</a>
            <button type="submit" class="mt-5 signin">Sign In</button>
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
<script src="{{ asset('dashboard/js/jquery.js') }}"></script>
<script src="{{ asset('dashboard/js/support.js') }}"></script>
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
<script>
    $(document).ready(function () {
        $(document).on('click','.signin', function(e){
            e.preventDefault();
            let data = {
                    'email': $('#email').val(),
                    'password': $('#password').val()
                };
                _ajax.post("{{ route('authenticating.member') }}",data,
                    (response) => {
                        if (response.status == 200) {
                            window.location.href = "{{ route('home') }}";
                        }
                    },
                    (response) => {
                        if (response.status == 400) {
                            _validation.action(response.responseJSON)
                        } else if (response.status == 422) {
                            $('.invalid_message').html(`<div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <div class="alert-message">
                                            ${response.responseJSON.message}
                                        </div>
                                    </div>`)
                        } else {
                            _swalert(response);
                        }
                    }
                );
        });
    });
</script>
</body>
</html>








