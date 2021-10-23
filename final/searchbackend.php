<?php
	$php_array = [
		"first_name" => "Tommy",
		"last_name" => "Trojan",
		"age" => 21,
		"phone" => [
			"cell" => "123-123-1234",

			"home" => "456-456-4567"
		],
	];

	$host = "303.itpwebdev.com";
	$user = "yunhaoz_db_user";
	$password = "20023303*Zyh";
	$db = "yunhaoz_final_db";

	$mysqli = new mysqli($host, $user, $password, $db);

	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	$sql = "select email,name,movies.movie,musics.music,foods.food,sports.sport,description,genders.gender
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
	on genders.gender_id = people.gender_id
	where 1=1";

	if(isset($_GET["email_id"]) && !empty($_GET["email_id"])) {

		$sql = $sql . " AND people.email = '" . $_GET["email_id"] ."'";
	}

	if(isset($_GET["name_id"]) && !empty($_GET["name_id"])) {

		$sql = $sql . " AND people.name like '%" . $_GET["name_id"] . "%'";
	}

	if(isset($_GET["movie_id"]) && !empty($_GET["movie_id"])) {

		$sql = $sql . " AND people.movie_id = " . $_GET["movie_id"];
	}

	if(isset($_GET["sport_id"]) && !empty($_GET["sport_id"])) {

		$sql = $sql . " AND people.sports_id = " . $_GET["sport_id"];
	}

	if(isset($_GET["music_id"]) && !empty($_GET["music_id"])) {

		$sql = $sql . " AND people.music_id = " . $_GET["music_id"];
	}

	if(isset($_GET["food_id"]) && !empty($_GET["food_id"])) {

		$sql = $sql . " AND people.food_id = " . $_GET["food_id"];
	}
	if(isset($_GET["gender_id"]) && !empty($_GET["gender_id"])) {

		$sql = $sql . " AND people.gender_id = " . $_GET["gender_id"];
	}

	$sql = $sql . ";";


	$results = $mysqli->query($sql);
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}

	$results_array = [];

	while( $row = $results->fetch_assoc()) {
		array_push($results_array, $row);
	}

	// Convert the assoc array to json string
	echo json_encode($results_array);


	$mysqli->close();


?>