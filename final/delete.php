<?php
session_start();
$host = "303.itpwebdev.com";
$user = "yunhaoz_db_user";
$password = "20023303*Zyh";
$db = "yunhaoz_final_db";

$mysqli = new mysqli($host, $user, $password, $db);

if($mysqli->connect_errno) {
	echo $mysqli->connect_error;
	exit();
}

$sql = "select idpeople,email,name,movies.movie,musics.music,foods.food,sports.sport,description,genders.gender
	from people
	left join movies
	on movies.movie_id = people.movie_id
	left join musics
	on musics.music_id = people.music_id
	left join foods
	on foods.food_id = people.food_id
	left join sports
	on sports.sport_id = people.sports_id
	left join genders
	on genders.gender_id = people.gender_id;";
$results = $mysqli->query($sql);
if(!$results) {
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
    <link rel="stylesheet" href="css/navbar.css">
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

		@media(max-width: 767px) {
			
			.container
			{
				width: auto;
			}

		}
		#search-results li
		{
			text-align: left;
			padding: 2px;
			font-size: 15px;
		}
		a
		{
			font-weight: 900;
		}
	</style>
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container">
		<h1>Welcome Administer</h1>
		<br>
		<div class="row" id="resultList">
			<h3 class="col-12 mt-3 mb-3">All Profiles</h3>
			<div class="col-12">
				<ol id="search-results">
					<?php while($row = $results->fetch_assoc()) : ?>
						<?php if( $row["idpeople"] != $_SESSION["people_id"] ): ?>
							<li>
								<ul>
								<a onclick="return confirm('Are you sure you want to delete this track?');" 
href="deleteconfirmation.php?idpeople=<?php echo $row['idpeople']; ?>&email=<?php echo $row['email']?>" class="btn btn-sm btn-outline-danger delete-btn">Delete</a>
								<a href="#"><?php echo "Email : " . $row["email"];?></a>
								<li><?php echo "Name : " . $row["name"];?> </li>
								<li><?php echo "Gender : " . $row["gender"];?> </li>
								<li><?php echo "Favorite Type of Movies : " . $row["movie"];?> </li>
								<li><?php echo "Favorite Type of Foods : " . $row["food"];?> </li>
								<li><?php echo "Favorite Type of Sports : " . $row["sport"];?> </li>
								<li><?php echo "Favorite Type of Musics : " . $row["music"];?> </li>
								<li><?php echo "Description : " . $row["description"];?> </li>
								</ul>
							</li>
							<br>
						<?php endif;?>
					<?php endwhile;?>
				</ol>
			</div>
		</div>
	</div>
	

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript"></script>

</body>
</html>