<?php
$host = "303.itpwebdev.com";
$user = "yunhaoz_db_user";
$password = "20023303*Zyh";
$db = "yunhaoz_dvd_db";

$mysqli = new mysqli($host, $user, $password, $db);

if($mysqli->connect_errno) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset("utf-8");

$sql = "select dvd_title_id,title,release_date,genres.genre,ratings.rating
from dvd_titles
left join genres
on genres.genre_id = dvd_titles.genre_id
left join ratings
on ratings.rating_id = dvd_titles.rating_id
where 1=1";

if(isset($_GET["title"]) && !empty($_GET["title"])) {

	$sql = $sql . " AND dvd_titles.title like '%" . $_GET["title"] ."%'";
}

if(isset($_GET["genre"]) && !empty($_GET["genre"])) {

	$sql = $sql . " AND dvd_titles.genre_id = " . $_GET["genre"];
}

if(isset($_GET["rating"]) && !empty($_GET["rating"])) {

	$sql = $sql . " AND dvd_titles.rating_id = " . $_GET["rating"];
}

if(isset($_GET["label"]) && !empty($_GET["label"])) {

	$sql = $sql . " AND dvd_titles.label_id = " . $_GET["label"];
}

if(isset($_GET["format"]) && !empty($_GET["format"])) {

	$sql = $sql . " AND dvd_titles.format_id = " . $_GET["format"];
}

if(isset($_GET["sound"]) && !empty($_GET["sound"])) {

	$sql = $sql . " AND dvd_titles.sound_id = " . $_GET["sound"];
}

if(isset($_GET["award"]) && !empty($_GET["award"])) {
	if($_GET["award"] == "yes")
	{
		$sql = $sql . " AND dvd_titles.award is not null";
	}
	else if($_GET["award"] == "no")
	{
		$sql = $sql . " AND dvd_titles.award is null";
	}
}

if(isset($_GET["release_date_from"]) && !empty($_GET["release_date_from"])) 
{
	$sql = $sql . " AND dvd_titles.release_date > '" . $_GET["release_date_from"] . "'";
}

if(isset($_GET["release_date_to"]) && !empty($_GET["release_date_to"])) {

	$sql = $sql . " AND dvd_titles.release_date < '" . $_GET["release_date_to"] . "'";
}


$sql = $sql . ";";

$results = $mysqli->query($sql);


if(!$results) {
	echo $mysqli->error;
	exit();
}

var_dump($results);

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DVD Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item active">Results</li>
	</ol>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4">
			<div class="col-12 mt-4">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				<?php
				echo "Showing " . $results->num_rows . " results";

				?>

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>DVD Title</th>
							<th>Release Date</th>
							<th>Genre</th>
							<th>Rating</th>
						</tr>
					</thead>
					<tbody>

<!-- 						<tr>
							<td>
								Title name.
							</td>
							<td>Release Date</td>
							<td>Genre</td>
							<td>Rating</td>
						</tr> -->
						<?php while($row = $results->fetch_assoc()) : ?>
							<tr>
								<td>
									<a onclick="return confirm('Are you sure you want to delete this track?');" 
href="delete.php?dvd_title_id=<?php echo $row['dvd_title_id']; ?>&title=<?php echo $row['title']?>" class="btn btn-outline-danger delete-btn">
	
										Delete

									</a>
								</td>
								<td>
									<a href="details.php?dvd_title_id=<?php echo $row['dvd_title_id']?>">
										<?php echo $row['title']; ?>		
									</a>
								</td>
								<td><?php echo $row["release_date"];?> </td>
								<td><?php echo $row["genre"];?> </td>
								<td><?php echo $row["rating"];?> </td>
							</tr>

						<?php endwhile;?>


					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</body>
</html>