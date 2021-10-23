<?php
	if ( !isset($_POST['title']) || 
		empty($_POST['title']) ) {

		$error = "Please fill out all required fields.";
	}
	else
	{
		$host = "303.itpwebdev.com";
		$user = "yunhaoz_db_user";
		$password = "20023303*Zyh";
		$db = "yunhaoz_dvd_db";

		$mysqli = new mysqli($host, $user, $password, $db);

		if($mysqli->connect_errno) {
			echo $mysqli->connect_error;
			exit();
		}

		if( isset($_POST["release_date"]) && !empty($_POST["release_date"])) {
			$release_date = "'" . $_POST["release_date"] . "'";
		}
		else {
			$release_date ="null";
		}

		if( isset($_POST["label_id"]) && !empty($_POST["label_id"])) {
			$label_id = $_POST["label_id"];
		}
		else {
			$label_id = "null";
		}
		if( isset($_POST["sound_id"]) && !empty($_POST["sound_id"])) {
			$sound_id = $_POST["sound_id"];
		}
		else {
			$sound_id = "null";
		}

		if( isset($_POST["genre_id"]) && !empty($_POST["genre_id"])) {
			$genre_id = $_POST["genre_id"];
		}
		else {
			$genre_id = "null";
		}

		if( isset($_POST["rating_id"]) && !empty($_POST["rating_id"])) {
			$rating_id = $_POST["rating_id"];
		}
		else {
			$rating_id = "null";
		}
		if( isset($_POST["format_id"]) && !empty($_POST["format_id"])) {
			$format_id = $_POST["format_id"];
		}
		else {
			$format_id = "null";
		}
		if( isset($_POST["award_id"]) && !empty($_POST["award_id"])) {
			$award_id = "'" . $_POST["award_id"] . "'" ;
		}
		else {
			$award_id = "null";
		}

		$title = $mysqli->real_escape_string($_POST["title"]);

		$sql="INSERT INTO dvd_titles(title,release_date,label_id,sound_id,genre_id,rating_id,format_id,award)
		VALUES('" . $title . "'," 
		. $release_date . " ,"
		. $label_id . " , "
		. $sound_id .","
		. $genre_id . ","
		. $rating_id . ", " 
		. $format_id . ", " 
		. $award_id . ");";


		$results = $mysqli->query($sql);
		if(!$results) {
			echo $mysqli->error;
			exit();
		}

		if( $mysqli->affected_rows == 1 ) {
			$isInserted = true;
		}

		$mysqli->close();
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="add_form.php">Add</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Add a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
<?php if( isset($error) && !empty($error)) :?>
				<div class="text-danger font-italic"><?php echo $error;?></div>
<?php endif;?>
<?php if( isset($isInserted)) :?>
				<div class="text-success"><span class="font-italic"><?php echo $_POST["title"];?></span> was successfully added.</div>
<?php endif;?>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="add_form.php" role="button" class="btn btn-primary">Back to Add Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>