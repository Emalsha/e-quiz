<?php 	
	require_once("../database/db.conf");
	$title = "Register As Administrator";
	session_start();

	if (isset($_POST['submit'])) {

		$fname = mysqli_real_escape_string($conn,$_POST['fname']);
		$lname = mysqli_real_escape_string($conn,$_POST['lname']);
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$username = mysqli_real_escape_string($conn,$_POST['uname']);
		$password = mysqli_real_escape_string($conn,$_POST['password']);

		$qry_to_check_usrname = "SELECT username FROM admin_user WHERE username='$username'";

		$results = mysqli_num_rows(mysqli_query($conn,$qry_to_check_usrname));

		if ($results == 1 | $username=="" ) {
			echo "<script type='text/javascript'> alert('Sorry. There is already exist admin account to this username. Please try another username.');</script>";
		}else{

			$query = "INSERT INTO admin_user (fname,lname,email,username,password) VALUES ('$fname','$lname','$email','$username','$password')";

			$res = mysqli_query($conn,$query);

			if($res == 1){
				echo "<script type='text/javascript'> alert('Congratulations. You registrate as Administrator.');</script>";	
			}else{
				echo "<script type='text/javascript'> alert($res);</script>";
			}
		}

	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title." | " ;?>e-quiz</title>
	<link rel="stylesheet" href="../../public/css/e-quiz.css">

	<script type="text/javascript">  // javascript function to check form 
		
		function checkForm(){

			//Check password
			var cpw = document.getElementById("confirm_password").value;
			var pw = document.getElementById("password").value;

			if(pw.length<8){
				alert("Please use stronger password. (Hint : use more than 8 charactors.)");
				return false;
			}

			if (pw != cpw) {
				alert('Password not match.');
				return false;
			}

		}

	</script>

</head>
<body>
	
	<?php
	include("../includes/header.php");
	include("../includes/nav_title.php");
	?>
	
	<div class="container">
		<div class="container-inside">
			<div class="block">
				
			</div>
			
			<div class="block_reg_form">
				
				<form action="" method="post" onsubmit="return checkForm()">
					<label for="fname">First Name : </label><br>
					<input type="text" name="fname" id="fname" placeholder="ex : John" ><br>
					<label for="lname">Last Name : </label><br>
					<input type="text" name="lname" placeholder="ex : Smith" ><br>
					<label for="email">E-mail : </label><br>
					<input type="email" name="email" id="email" placeholder="sample@mail.com" required><br>

					<label for="uname">Username : <span>*</span></label>					
					<span style="font-size:.7em;color:grey;">This username use to login system.</span><br>
					<input type="text" name="uname" id="username" placeholder="ex : jsmith" required><br>
					
					<table style="width:100%; ">
						<tr>
							<td>
								<label for="password">Enter Password : <span>*</span></label><br>
								<input type="password" id="password" name="password" placeholder="********" required><br>
							</td>
							
							<td>
								<label for="password">Confirm Password : <span>*</span></label><br>
								<input type="password" id="confirm_password" name="confirm_password" placeholder="********" required><br>
							</td>
						</tr>

					</table>					
					
					<input type="submit" name="submit" value="Register" style="width:40%; float:right;">
				</form>

				<br><br><br>
			</div>

			<div class="block">
				<center>
				<p style="font-size:.8em;">Already a Administrator.</p>
				<a href="login.php">Login here.</a>
				<hr>
				<a href="../index.php" style="padding:10px;">Login as User.</a>
				</center>
			</div>
		</div>
	</div>
</body>
</html>