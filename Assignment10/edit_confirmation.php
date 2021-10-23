<?php
/*var_dump($_POST);*/
$isUpdated = false;

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


		$statement = $mysqli->prepare("UPDATE dvd_titles SET title = ?, release_date = ?, award = ?, label_id = ?, sound_id = ?, genre_id = ?, rating_id = ?, format_id = ? WHERE dvd_title_id = ?");
		$statement->bind_param("sssiiiiii", $_POST['title'], $_POST['release_date'], $_POST["award"], $_POST["label"], $_POST["sound"], $_POST["genre"], $_POST["rating"], $_POST["format"], $_POST["dvd_title_id"]);
		$executed = $statement->execute();

		if(!$executed) {
			echo $mysqli->error;
		}

		if($statement->affected_rows == 1) {
			$isUpdated = true;
		}

		$statement->close();
		
		$mysqli->close();
	}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Confirmation | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item"><a href="details.php">Details</a></li>
		<li class="breadcrumb-item"><a href="edit_form.php">Edit</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Edit a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
<?php if( isset($error) && !empty($error)) :?>
				<div class="text-danger font-italic"><?php echo $error;?></div>
<?php endif;?>
<?php if ($isUpdated) : ?>
				<div class="text-success"><span class="font-italic"><?php echo $_POST['title']; ?></span> was successfully edited.</div>
<?php endif; ?>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="details.php?dvd_title_id=<?php echo $_POST["dvd_title_id"]; ?>" class="btn btn-primary">Back to Details</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>