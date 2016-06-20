<?php 
	
	session_start();
	$error = "";
	$title = "Administrator Login" ;

	if (isset($_POST['username']) && isset($_POST['password'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password is invalid";
			/*header("location:user_login_error.php");*/
		}else{
			//define username and password
			$username = $_POST['username'];
			$password = $_POST['password'];

			//Establish connection 
			$conn = mysqli_connect("localhost","Emalsha","1994224er","e_qize_db");

			if (!$conn) {
				$error= "Mysql database connection error";
			}

			//To protect mysql injection 
			$username = stripslashes($username);
			$password = stripslashes($password);

			$username = mysqli_real_escape_string($conn,$username);
			$password = mysqli_real_escape_string($conn,$password);

			//Query
			$query ="SELECT username,password FROM users where username = '$username' AND password = '$password'";

			//Result
			$res = mysqli_query($conn,$query);

			//Number of results
			$rows = mysqli_num_rows($res);

			//Check are there any results
			if ($rows == 1) {
				$_SESSION['login_user']=$username; //Initialize session
				header("location:home.php"); //rederect to admin home
			}else{
				$error = "Username or Password is invalid.";				
				//header("location:user_login_error.php");
			}
		}
	}else{
		//header("location:../index.php");
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
				<h3>Login as administrator, create papers and publish it.</h3>
			</div>

			<div class="block_bordered">
				<center><h2>Login as Administrator</h2>
				<form action="" method="post">
					<label for="username">Username </label><br>
					<input type="text" name="username" placeholder="username" required><br>
					<label for="password">Password </label><br>
					<input type="password" name="password" placeholder="*********" required><br>
					<input type="submit" value="Login">
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