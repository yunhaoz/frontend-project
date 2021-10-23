<?php
$host = "303.itpwebdev.com";
$user = "yunhaoz_db_user";
$password = "20023303*Zyh";
$db = "yunhaoz_final_db";

$mysqli = new mysqli($host, $user, $password, $db);

if($mysqli->connect_errno) {
	echo $mysqli->connect_error;
	exit();
}

$resultsfood = $mysqli->query("SELECT * FROM foods;");
$resultsmovie = $mysqli->query("SELECT * FROM movies;");
$resultsmusic = $mysqli->query("SELECT * FROM musics;");
$resultssport = $mysqli->query("SELECT * FROM sports;");
$resultsgender = $mysqli->query("SELECT * FROM genders;");



if(!$resultsfood && !$resultsmovie && !$resultsmusic && !$resultssport) {
	echo $mysqli->error;
	exit();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register Page</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style type="text/css">
		body {
			background-color: #FFF1E6;
		}
		.container
		{
			width: 700px;
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
			font-size: 18px;
			font-weight: 900;
		}
		.btn
		{
			background-color: #CB997E;
			color: #F0EFEB;
			border-color: #CB997E;
			width: 200px;
			margin-left: auto;
			margin-right: auto;
		}

		@media(max-width: 767px) {
			
			.container
			{
				width: auto;
			}

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
		<h1>Join Find Friends</h1>
		<br>
		<form action="registerconfirmation.php" method="POST">
			<div class="form-group row">
			    <label for="inputEmail" class="col-sm-2 col-form-label">Email<span class="text-danger">*</span></label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="inputEmail" placeholder="email" name="email_id" required autofocus>
			      <small id="email-error" class="invalid-feedback">Email character is no more then 50.</small>
			    </div>
			</div>
			<div class="form-group row">
			    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="inputName" placeholder="name" name="name_id">
			      <small id="username-error" class="invalid-feedback">User Name character is no more then 50.</small>
			    </div>
			</div>
			<div class="form-group row">
			    <label for="inputPassword" class="col-sm-2 col-form-label">Password<span class="text-danger">*</span></label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" id="inputPassword" placeholder="password" name="password_id" required autofocus>
			    </div>
			</div>
			<div class="form-group row">
				<label for="movie_id" class="col-sm-2 col-form-label">Movies</label>
				<div class="col-sm-10">
					<select class="custom-select" id="movie_id" name="movie_id">
						<option value="" selected disabled>-- Select your favorite types of Movie --</option>
						<?php while( $row = $resultsmovie->fetch_assoc() ) : ?>

							<option value="<?php echo $row["movie_id"]; ?>">
								<?php echo $row["movie"]; ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="sport_id" class="col-sm-2 col-form-label">Sports</label>
				<div class="col-sm-10">
					<select class="custom-select" id="sport_id" name="sport_id">
						<option value="" selected disabled>-- Select your favorite types of Sport --</option>
					    <?php while( $row = $resultssport->fetch_assoc() ) : ?>

							<option value="<?php echo $row["sport_id"]; ?>">
								<?php echo $row["sport"]; ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div>
			
			<div class="form-group row">
				<label for="food_id" class="col-sm-2 col-form-label">Food</label>
				<div class="col-sm-10">
					<select class="custom-select" id="food_id" name="food_id">
					    <option value="" selected disabled>-- Select your favorite types of Food --</option>
					    <?php while( $row = $resultsfood->fetch_assoc() ) : ?>

							<option value="<?php echo $row["food_id"]; ?>">
								<?php echo $row["food"]; ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div>


			<div class="form-group row">
				<label for="music_id" class="col-sm-2 col-form-label">Music</label>
				<div class="col-sm-10">
					<select class="custom-select" id="music_id" name="music_id">
					    <option value="" selected disabled>-- Select your favorite types of Music --</option>
					    <?php while( $row = $resultsmusic->fetch_assoc() ) : ?>

							<option value="<?php echo $row["music_id"]; ?>">
								<?php echo $row["music"]; ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="gender_id" class="col-sm-2 col-form-label">Gender</label>
				<div class="col-sm-10">
					<select class="custom-select" id="gender_id" name="gender_id">
					    <option value="" selected disabled>-- Select your Gender --</option>
					    <?php while( $row = $resultsgender->fetch_assoc() ) : ?>
							<option value="<?php echo $row["gender_id"]; ?>">
								<?php echo $row["gender"]; ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div>



			<div class="form-group row">
				<label for="des_id" class="col-sm-2 col-form-label text-sm-right">Description:</label>
				<div class="col-sm-10">
					<textarea name="des_id" id="des_id" class="form-control" placeholder="You can make self introduction and leave your contact information"></textarea>
					<small id="des-error" class="invalid-feedback">Description character is no more then 100.</small>
				</div>
			</div>

			<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
			<button class="btn btn-lg btn-primary btn-block" type="reset">Reset</button>
		</form>
	</div>
	

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript"></script>

    <script>
		// Client-side input validation
		document.querySelector('form').onsubmit = function(){
			if ( document.querySelector('#inputEmail').value.trim().length >= 50 ) {
				document.querySelector('#inputEmail').classList.add('is-invalid');
			} else {
				document.querySelector('#inputEmail').classList.remove('is-invalid');
			}

			if ( document.querySelector('#inputName').value.trim().length >= 50 ) {
				document.querySelector('#inputName').classList.add('is-invalid');
			} else {
				document.querySelector('#inputName').classList.remove('is-invalid');
			}

			if ( document.querySelector('#des_id').value.trim().length >= 100 ) {
				document.querySelector('#des_id').classList.add('is-invalid');
			} else {
				document.querySelector('#des_id').classList.remove('is-invalid');
			}

			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>
	<div class="footer">
		producted by Yunhao Zhao @2020 itp303
	</div>
</body>
</html>