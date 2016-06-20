<?php 	
		$title = "User Login" ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title." | " ;?>e-quiz</title>
	<link rel="stylesheet" href="../../public/css/e-quiz.css">
</head>
<body>
	<?php
	include("../includes/header.php");
	include("../includes/nav_title.php");
	?>
	
	<div class="container">
		<div class="container-inside">
			<div class="block_bordered">
				<p>! Username or password you entered is invalid.</p>
				<p>Please try again or if you are not a registered yet please click on Register.</p>
			</div>

			<div class="block_bordered">
				<center><h2>Login as user</h2>
				<form action="http://localhost/web_development/e-quiz/application/user/user_login.php" method="post">
					<label for="username">Username </label><br>
					<input type="text" name="username" placeholder="username" required><br>
					<label for="password">Password </label><br>
					<input type="password" name="password" placeholder="password" required><br>
					<input type="submit" value="Login">
				</form>
				<a href="">Register</a>
				<hr>
				<a href="" style="padding:10px;">Login as Administrator</a>
				</center>
			</div>
		</div>
	</div>
</body>
</html>