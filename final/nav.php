<nav class="container-fluid">
	<div class="row">
		<div class="col-12 d-flex justify-content-end">

	<?php if(!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) : ?>

			<a class="p-2 text-right" href="../login.php">Login</a>
			<a class="p-2 text-right" href="../register.php">Sign up</a>

	<?php else: ?>

			<div class="p-2">Hello <?php echo $_SESSION["email"]; ?>!</div>
			<a class="p-2" href="logout.php">Logout</a>
			
	<?php endif; ?>

		</div>
	</div> <!-- .row -->
</nav>