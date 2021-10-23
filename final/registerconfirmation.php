<?php


	if ( !isset($_POST['email_id']) || 
		empty($_POST['email_id']) || !isset($_POST['password_id']) || 
		empty($_POST['password_id'])) {

		$error = "Please fill out all required fields.";
	}
	else
	{
		$host = "303.itpwebdev.com";
		$user = "yunhaoz_db_user";
		$password = "20023303*Zyh";
		$db = "yunhaoz_final_db";

		$mysqli = new mysqli($host, $user, $password, $db);

		if($mysqli->connect_errno) {
			echo $mysqli->connect_error;
			exit();
		}

		// Check if username or email address is already taken (aka exists in the users table)
		$sql_registered = "SELECT * FROM people 
		WHERE email = '" . $_POST["email_id"] . 
		"';";

		$results_registered = $mysqli->query($sql_registered);
		if(!$results_registered) {
			echo $mysqli->error;
			exit();
		}

		// num_rows is the # of matches
		if($results_registered->num_rows > 0) {
			$error = "Email has been already taken. Please choose another one.";
		}
		else
		{

			if( isset($_POST["name_id"]) && !empty($_POST["name_id"])) {
				$name_id = $mysqli->real_escape_string($_POST["name_id"]);
			}
			else {
				$name_id = "null";
			}

			if( isset($_POST["des_id"]) && !empty($_POST["des_id"])) {
				$des_id = $mysqli->real_escape_string($_POST["des_id"]);
			}
			else {
				$des_id = "null";
			}

			if( isset($_POST["movie_id"]) && !empty($_POST["movie_id"])) {
				$movie_id = $_POST["movie_id"];
			}
			else {
				$movie_id = "null";
			}

			if( isset($_POST["music_id"]) && !empty($_POST["music_id"])) {
				$music_id = $_POST["music_id"];
			}
			else {
				$music_id = "null";
			}
			if( isset($_POST["sport_id"]) && !empty($_POST["sport_id"])) {
				$sport_id = $_POST["sport_id"];
			}
			else {
				$sport_id = "null";
			}
			if( isset($_POST["food_id"]) && !empty($_POST["food_id"])) {
				$food_id = "'" . $_POST["food_id"] . "'" ;
			}
			else {
				$food_id = "null";
			}
			if( isset($_POST["gender_id"]) && !empty($_POST["gender_id"])) {
				$gender_id = "'" . $_POST["gender_id"] . "'" ;
			}
			else {
				$gender_id = "null";
			}

			$email_id = $mysqli->real_escape_string($_POST["email_id"]);
			$password_id = hash("sha256",$_POST["password_id"]);

			$sql="INSERT INTO people(email,name,password,movie_id,music_id,food_id,gender_id,sports_id,description)
			VALUES('" . $email_id . "','"
			. $name_id . "','"
			. $password_id . "', "
			. $movie_id .","
			. $music_id . ","
			. $food_id . ", "
			. $gender_id . ", "
			. $sport_id . ",' " 
			. $des_id . "');";


			$results = $mysqli->query($sql);
			if(!$results) {
				echo $mysqli->error;
				exit();
			}

			if( $mysqli->affected_rows == 1 ) {
				$isInserted = true;
			}
		}

		$mysqli->close();
	}

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
		<h1>REGISTERING...</h1>
		<div class="row">
			<div class="col-12">

<?php if( isset($error) && !empty($error)) :?>
				<div class="text-danger"><?php echo $error;?></div>
<?php endif;?>
<?php if( isset($isInserted)) :?>
				<div class="text-success">
					User <?php echo $_POST["email_id"];?> was successfully registered.</div>
<?php endif;?>

			</div>
		</div>
			<div class="col-12">
				<a href="login.php" role="button" class="btn btn-primary">Back to Login</a>
			</div>
	</div>
	

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript"></script>
    <div class="footer">
		producted by Yunhao Zhao @2020 itp303
	</div>
</body>
</html>