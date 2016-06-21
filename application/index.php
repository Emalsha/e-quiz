<?php 	
		$title = "WELCOME" ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title." | " ;?>e-quiz</title>
	<link rel="stylesheet" href="../public/css/e-quiz.css">
</head>
<body>
	<?php
	include("includes/header.php");
	include("includes/nav_title.php");
	?>
	
	<div class="container">
		<div class="container-inside">
			<div class="block">
				<h3> What is this ?</h3>	
				<p>e-qize is a online question generator service.You can create online question paper and publish it.Students can log in to there account and search for given test.MCQ , True false questions , Write description questions are able in this question geneerator service.</p>
			</div>
			
			<div class="block">
				<h3>How use this ?</h3>
				<p>If you want to create a quiz log in as a administrator.If you want to attempt to quiz log-in as a user.</p>
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
				<a href="user/register.php">Register</a>
				<hr>
				<a href="admin/login.php" style="padding:10px;">Login as Administrator</a>
				</center>
			</div>
		</div>
	</div>
</body>
</html>