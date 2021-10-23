<?php
session_start();
if( !isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) 
{
	if ( isset($_POST['email']) && isset($_POST['password']) ) {
		if ( empty($_POST['email']) || empty($_POST['password']) ) 
		{
			$error = "Please enter email and password.";
		}
		else {
			// User did enter username/password but need to check
			$host = "303.itpwebdev.com";
			$user = "yunhaoz_db_user";
			$password = "20023303*Zyh";
			$db = "yunhaoz_final_db";

			$mysqli = new mysqli($host, $user, $password, $db);

			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}

			$passwordInput = hash("sha256", $_POST["password"]);
			$sql = "SELECT * FROM people
					WHERE email = '" . $_POST['email'] . "' AND password = '" . $passwordInput . "';";
			
			$results = $mysqli->query($sql);
			$row = $results->fetch_assoc();

			if(!$results) {
				echo $mysqli->error;
				exit();
			}
			// If we get 1 result back, means username/pw combination is correct.
			if($results->num_rows > 0) {
				if($_POST["email"]=="administer@usc.edu")
				{
					$_SESSION["email"] = $_POST["email"];
					$_SESSION["people_id"] = $row["idpeople"];
					$_SESSION["logged_in"] = true;
					header("Location: delete.php");
				}
				else
				{
					$_SESSION["email"] = $_POST["email"];
					$_SESSION["people_id"] = $row["idpeople"];
					$_SESSION["logged_in"] = true;
					header("Location: homepage.php");
				}
				
			}
			else {
				$error = "Invalid username or password.";
			}
		} 
	}
}
else 
{
	header("Location: homepage.php");
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style type="text/css">
		body {
			background-color: #FFF1E6;
		}
		.container
		{
			width: 60%;
			padding:20px;
			margin:10px;
			height: auto;
			margin-left: auto;
			margin-right: auto;
			font-family: sans-serif;
			text-align: center;
			color: #A87E69;
			background-color: #E9D4C8;
			border-radius: 20px;
			font-size: 45px;
			text-shadow: 1px 1px #696969;
		}
		.smcontainer
		{
			width: 30%;
			margin-left: auto;
			margin-right: auto;
			display: flex;
			font-family: sans-serif;
			font-size: 180%;
			color: #A87E69;
			text-shadow: 3px 2px #696969;
			border-radius: 20px;
		}

		.heart {
		  text-align: center;
		  margin:0;
		  padding:0;
		  width:60%;
		}

		.heart:hover {
		  animation: heartbeat 1.5s linear infinite;
		  color: #CB997E;
		}

		@keyframes textcolor {
			0% {
		    color: #CB997E;
			}
			5% {
		    color: #CB997E;
			}
			15% {
		    color: #E7D7CA;
			}
			25% {
		    color: #CB997E;
			}
			35% {
		    color: #CB997E;
			}
			45% {
		    color: #E7D7CA;
			}
			55% {
		    color: #CB997E;
			}
			65% {
		    color: #CB997E;
			}
		}
		@keyframes heartbeat {
			0% {
		    transform: scale(1);
		    color: #CB997E;
			}
			5% {
		    transform: scale(1.1);
		    color: #CB997E;
			}
			15% {
		    transform: scale(0.8);
		    color: #E7D7CA;
			}
			25% {
		    transform: scale(1.2);
		    color: #CB997E;
			}
			35% {
		    transform: scale(0.8);
		    color: #CB997E;
			}
			45% {
		    transform: scale(1.05);
		    color: #E7D7CA;
			}
			55% {
		    transform: scale(0.85);
		    color: #CB997E;
			}
			65% {
		    transform: scale(1);
		    color: #CB997E;
			}
		}
		.login
		{
			margin-top: 20px;
			margin-left: auto;
			margin-right: auto;
			width: 30%;
		}
		.checkbox
		{
			margin-top:10px;
			font-size: 15px;
			text-shadow: 0px 0px #696969;
		}
		.btn
		{
			background-color: #CB997E;
			color: #F0EFEB;
			border-color: #CB997E;
		}
		a
		{
			font-size: 10px;
			text-shadow: 0px 0px #696969;
			color:;
		}

		@media(max-width: 991px) {
			.smcontainer
			{
				width: 40%;
			}
			.login
			{
				width: 50%;
			}

		}
		/* Add the following css for screen sizes less than 591px*/
		@media(max-width: 767px) {
			
			.smcontainer
			{
				width: 60%;
			}
			.login
			{
				width: 70%;
			}

		}
		.font-italic
		{
			font-size: 10px;
			text-shadow: 0px 0px #696969;
		}
		.footer
		{
			position: fixed;
			background-color: black;
			width: 100%;
			text-align: center;
			bottom:0;
			color: white;
			font-size: 10px;
		}


    </style>
</head>
 <body>
 	<div class="container">
 		<div class="title">WELCOME TO FIND FRIENDS</div>
 		<div class="smcontainer">
 			<div class="letter-1">F</div>
			<div class="heart">&</div>
			<div class="letter-2">F</div>
 		</div>
 		<div class="login">
 			<form action="login.php" class="form-signin" method="POST">
 				<div class="row mb-3">
					<div class="font-italic text-danger col-sm-12">
						<?php
							if ( isset($error) && !empty($error) ) {
								echo $error;
							}
						?>
					</div>
				</div>

		 		<label for="inputEmail" class="sr-only">Email address</label>
		 		<input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
		 		<small id="email-error" class="invalid-feedback">Email character is no more then 50.</small>
		 		<label for="inputPassword" class="sr-only">Password</label>
  				<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
  				<div class="checkbox mb-3">
				    <label>
				    	<input type="checkbox" value="remember-me"> Remember me
				    </label>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
				<button class="btn btn-lg btn-primary btn-block" type="reset">Reset</button>
				<a href="register.php">No account? Register</a>
		 	</form>
 		</div>
 	</div>





	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript">
		$(document).ready(function () {
		    $(".heart").hover(function () {
		        $(".letter-1").css("animation", "textcolor 1.5s linear infinite");
		        $(".letter-2").css("animation", "textcolor 1.5s linear infinite");
		        $(".title").css("animation", "textcolor 1.5s linear infinite");
		        $(".container").css("background-color", "#FFF1E6");
		    });
		    $(".heart").mouseleave(function () {
		        $(".letter-1").css("animation", "");
		        $(".letter-2").css("animation", "");
		        $(".title").css("animation", "");
		        $(".container").css("background-color", "#E9D4C8");
		    });
		});
	</script>

	<script>
		// Client-side input validation
		document.querySelector('form').onsubmit = function(){
			if ( document.querySelector('#inputEmail').value.trim().length >= 50 ) {
				document.querySelector('#inputEmail').classList.add('is-invalid');
			} else {
				document.querySelector('#inputEmail').classList.remove('is-invalid');
			}

			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>
	<div class="footer">
		producted by Yunhao Zhao @2020 itp303
	</div>
	
</body>
</html>