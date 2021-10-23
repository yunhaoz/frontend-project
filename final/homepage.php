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

$mysqli->set_charset("utf-8");

$sql = "select name,movies.movie,musics.music,foods.food,sports.sport,description
from people
left join movies
on movies.movie_id = people.movie_id
left join musics
on musics.music_id = people.music_id
left join foods
on foods.food_id = people.food_id
left join sports
on sports.sport_id = people.sports_id
where email = '" . $_SESSION["email"] . "';";

$results = $mysqli->query($sql);

if(!$results) {
	echo $mysqli->error;
	exit();
}

$row = $results->fetch_assoc();

$mysqli->close();

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
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

		.anime
		{
			width: 160px;
			height: 40px;
			margin-left: auto;
			margin-right: auto;
			background-color: #CB997E;
			border-radius: 5px 0 0 5px;
			text-align: center;
			color: white;
			cursor: pointer;
			position: relative;
		}

		.line { 
			right: -5px;
		    top: 0;
		    width: 5px;
		    height: 80px;
		    border-radius: 0 5px 0 0;
		    background: #99735F;
		    position: absolute;
		    transition: 1.6s;
		}

		.line-end {
			right: -6.5px;
		    bottom: -42px;
			width: 8px;
		    height: 10px;
		    border-radius: 0 0 10px 10px;
		    background: #A5A58D;
		    position: absolute;
		    transition: 1.6s;
		}

		.blind {
		    position: absolute;
		    width: 20px;
		    height: 0;
		    background-color: #F0EFEB;
		    opacity: 0.8;
		    top: 0;
		}

		#l1 {
			border-radius: 5px 0 0 5px;
		  	left: 0;
		  	transition: 200ms;
		}
		#l2 {
		    left: 20px;
		    transition: 400ms;
		}
		#l3 {
		    left: 40px;
		    transition: 600ms;
		}
		#l4 {
		    left: 60px;
		    transition: 800ms;
		}
		#l5 {
		    left: 80px;
		    transition: 1s;
		}
		#l6 {
		    left: 100px;
		    transition: 1.2s;
		}
		#l7 {
		    left: 120px;
		    transition: 1.4s;
		}
		#l8 {
		    left: 140px;
		    transition: 1.6s;
		}

		.anime:hover .blind {
		    height: 40px;
		}

		.anime:hover body {
		  	background-color: black;
		}

		.anime:hover .line {
		    height: 60px;
		}

		.anime:hover .line-end {
		    bottom: -22px;
		}
		.myprofile
		{
			margin-left: auto;
			margin-right: auto;
			width: 1000px;
			margin-top: 50px;
			display: flex;
		}
		.circle
		{
			width: 150px;
			height:150px;
			background-color: #E7D7CA;
			border-radius: 50%;
			text-align: center;
			font-size: 20px;
			opacity: 0;
			transition: 2s;
			padding-top: 25px;
			
		}
		#c1,#c3,#c5
		{
			margin-top:140px;
		}
		#c6
		{
			width: 260px;
			height: 260px;
			font-size: 15px;
			padding: 40px;
		}

		@media(max-width: 991px) {

			.myprofile
			{
				width: 400px;
				display: block;
				
			}
			#c1,#c2,#c3,#c4,#c5,#c6
			{
				margin-top:10px;
				margin-left: auto;
				margin-right: auto;
			}
		}
		/* Add the following css for screen sizes less than 591px*/
		@media(max-width: 767px) {		}

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
	<nav class="navbar">
	    <a class="navbar-brand" href="homepage.php">MY F&F</a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars" aria-controls="navbars" aria-expanded="false">
	    <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbars">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active" id="bar1">
		        <a class="nav-link" href="homepage.php" >My F&F<span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item" id="bar2">
		        <a class="nav-link" href="search.html">Find My Friends</a>
		      </li>
		      <li class="nav-item" id="bar3">
		        <a class="nav-link" href="edit.php">Edit My Profiles</a>
		      </li>
		    </ul>
	  </div>
	</nav>
	<?php include 'nav.php'; ?>



<!-- inspire from codepen -->
	<div class="anime">
		<h2>F&F</h2>
		<div class="line"></div>
		<div class="line-end"></div>
		<div class="blind" id="l1"></div>
	    <div class="blind" id="l2"></div>
	    <div class="blind" id="l3"></div>
	    <div class="blind" id="l4"></div>
	    <div class="blind" id="l5"></div>
	    <div class="blind" id="l6"></div>
	    <div class="blind" id="l7"></div>
	    <div class="blind" id="l8"></div>
	</div>

	<div class="myprofile">

		<div class="circle" id="c1">
			<?php if($row["name"]!=null):?>
				<?php echo "<p>Name:<p>".$row["name"];?>
			<?php else: ?>
				<?php echo "<p>Name:<p>Unknown";?>
			<?php endif;?>
		</div>
		<div class="circle" id="c2">
			<?php if($row["movie"]!=null):?>
				<?php echo "<p>Movie:<p>".$row["movie"];?>
			<?php else: ?>
				<?php echo "<p>Movie:<p>Unknown";?>
			<?php endif;?>
		</div>
		<div class="circle" id="c3">
			<?php if($row["food"]!=null):?>
				<?php echo "<p>Food:<p>" . $row["food"];?>
			<?php else: ?>
				<?php echo "<p>Food:<p>Unknown";?>
			<?php endif;?>
		</div>
		<div class="circle" id="c4">
			<?php if($row["music"]!=null):?>
				<?php echo "<p>Music:<p>" . $row["music"];?>
			<?php else: ?>
				<?php echo "<p>Music:<p>Unknown";?>
			<?php endif;?>
		</div>
		<div class="circle" id="c5">
			<?php if($row["sport"]!=null):?>
				<?php echo "<p>Sport:<p>" . $row["sport"];?>
			<?php else: ?>
				<?php echo "<p>Sport:<p>Unknown";?>
			<?php endif;?>
		</div>
		<div class="circle" id="c6">
			<?php if($row["description"]!=null):?>
				<?php echo "<p>Description:<p>" . $row["description"];?>
			<?php else: ?>
				<?php echo "<p>Description:<p>Unknown";?>
			<?php endif;?>
		</div>
	</div>

	


	

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript">
		$(document).ready(function () {
		    $(".anime").hover(function () {
		        $("body").css("background-color", "black");
		        $(".navbar").css("opacity", "0");
		        $(".circle").css("opacity", "1");
		    });
		    $(".anime").mouseleave(function () {
		    	$("body").css("background-color", "#FFF1E6");
		        $(".navbar").css("opacity", "1");
		        $(".circle").css("opacity", "0");
		    });
		});
	</script>

	<div class="footer">
		producted by Yunhao Zhao @2020 itp303
	</div>
</body>
</html>