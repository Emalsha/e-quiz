<?php 
	
	include_once("../database/db.conf");
	session_start();
	$error = "";

	if (isset($_POST['username']) && isset($_POST['password'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password is invalid";
			header("location:user_login_error.php");
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
			$query ="SELECT username,password FROM users where username = '$username' AND password = '$password'";

			//Result
			$res = mysqli_query($conn,$query);

			//Number of results
			$rows = mysqli_num_rows($res);

			//Check are there any results
			if ($rows == 1) {
				$_SESSION['login_user']=$username; //Initialize session
				header("location:home.php"); //rederect to user home
			}else{
				$error = "Username or Password is invalid.";				
				header("location:user_login_error.php");
			}
		}
	}else{
		header("location:../index.php");
	}
	
	echo $error;

 ?>