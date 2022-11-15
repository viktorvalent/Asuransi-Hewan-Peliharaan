
<?php

// if(isset($_POST["login"])){


// 	$email = $_POST ["email"];
// 	$password = $_POST ["password"];

// 	$result = mysqli_query($conn, "SELECT * FORM user WHERE
// 		username = '$username'");


// 	if(mysqli_num_rows($result)) == 1 ) {

// 		$row = mysqli_fetch_assoc ($result);
// 		if( password_verify($password, $row["password"])) {
// 			header("location : index.php");
// 			exit;
// 		}
// 	}

// 	$error = true;

// }


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{asset('css/style.css') }}">
    <!-- <link rel="stylesheet" href="{{asset('js/login.js') }}"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous"><!-- fontawesom cdn link -->

</head>
<body>
<!-- <h2>Weekly Coding Challenge #1: Sign in/up Form</h2> -->
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="#" method ="POST">
			<h3>Create Account</h3>
			
			<span>or use your email for registration</span>
			<input type="text" name="name" id = "name" required value="" placeholder="Name">
			<input type="email" name="email" id = "email" required value="" placeholder="email">
			<input type="password" name="password" id = "password" required value="" placeholder="Passowrd">
			<input type="password" name="confirmpassword" id = "confirmpassword" required value="" placeholder="Re-Password"> 
			<button class="mt-5">Sign Up</button>
		</form>
	</div>


	
	<div class="form-container sign-in-container">
		<form action="#">
			<h3>Sign in</h3>
			
			<span  class="mb-3">or use your account</span>
			<input type="text" name="email" id = "email" required value="" placeholder="email">
			<input type="password" name="password" id = "password" required value="" placeholder="password">
			<a href="{{ asset('views/indexs.php') }}">Forgot your password?</a>
			<button class="mt-5">Sign In</button>
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


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

  </body>
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
</html>








