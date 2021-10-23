<?php
session_start();
$isDeleted = false;

if ( !isset($_GET['idpeople']) || empty($_GET['idpeople']) 
		|| !isset($_GET['email']) || empty($_GET['email']) ) {
	$error = "Invalid Email.";
}
else {
	$host = "303.itpwebdev.com";
	$user = "yunhaoz_db_user";
	$password = "20023303*Zyh";
	$db = "yunhaoz_final_db";

	$mysqli = new mysqli($host, $user, $password, $db);

	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	$sql = "DELETE FROM people
	WHERE idpeople = " . $_GET["idpeople"] . ";";


	$results = $mysqli->query($sql);

	if(!$results){
		echo $mysqli->error;
		exit();
	}	

	// Make sure this was succesful
	if($mysqli->affected_rows == 1) {
		$isDeleted = true;
	}


	$mysqli->close();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Page</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style type="text/css">
		body {
			background-color: #FFF1E6;
			transition: 2s;
			font-weight: 900;
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
	<?php include 'nav.php'; ?>
	<div class="container">
		<h1>EDITING...</h1>
		<div class="row mt-4">
			<div class="col-10">

			<?php if( isset($error) && !empty($error)) :?>
							<div class="text-danger"><?php echo $error;?></div>
			<?php endif;?>
			<?php if ($isDeleted) : ?>
							<div class="text-success">User<?php echo $_GET['email']; ?>was successfully deleted.</div>
			<?php endif; ?>

			</div>
		</div>
			<div class="col-12">
				<a href="delete.php" role="button" class="btn btn-primary">Administration Page</a>
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