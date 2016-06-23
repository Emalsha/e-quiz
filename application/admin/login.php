<?php 
	require_once("../database/db.conf");
	session_start();
	$error = "";
	$title = "Administrator Login" ;

	if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password is invalid";
		}else{
			//define username and password
			$username = $_POST['username'];
			$password = $_POST['password'];

			

			//To protect mysql injection 
			$username = stripslashes($username);
			$password = stripslashes($password);

			$username = mysqli_real_escape_string($conn,$username);
			$password = mysqli_real_escape_string($conn,$password);

			//Query
			$query ="SELECT username,password,admin_id FROM admin_user where username = '$username' AND password = '$password'";

			//Result
			$res = mysqli_query($conn,$query);

			//get data
			$data = mysqli_fetch_assoc($res);

			//Number of results
			$rows = mysqli_num_rows($res);

			//Check are there any results
			if ($rows == 1) {
				$_SESSION['login_admin']=$username; //Initialize session
				$_SESSION['admin_id']=$data['admin_id'];
				header("location:home.php"); //rederect to admin home
			}else{
				$error = "Username or Password is invalid.";
				echo "<script type='text/javascript'>alert('Username or password is invalid.');</script>";
			}
		}
	}	
		
?>
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
			<div class="block">
				<h4>Login as administrator, create papers and publish it.</h4>
			</div>

			<div class="block_bordered">
				<center><h2>Login as Administrator</h2>
				<form action="" method="post">
					<label for="username">Username </label><br>
					<input type="text" name="username" placeholder="username" required><br>
					<label for="password">Password </label><br>
					<input type="password" name="password" placeholder="*********" required><br>
					<input type="submit" name="submit" value="Login">
				</form>
				<a href="register.php">Register</a>
				<hr>
				<a href="../index.php" style="padding:10px;">Login as User.</a>
				</center>
			</div>
		</div>
	</div>
</body>
</html>