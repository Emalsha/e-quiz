<?php 	
		$title = "Register Administrator" ;
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
			<div class="block">
				
			</div>
			
			<div class="block_reg_form">
				
				<form action="http://localhost/web_development/e-quiz/application/user/register_function.php" method="post">
					<label for="fname">First Name : </label><br>
					<input type="text" name="fname" placeholder="ex : John" ><br>
					<label for="lname">Last Name : </label><br>
					<input type="text" name="lname" placeholder="ex : Smith" ><br>
					<label for="uname">Username : <span>*</span></label>					
					<span style="font-size:.7em;color:grey;">This username use to login system.</span><br>
					<input type="text" name="uname" placeholder="ex : jsmith" required><br>
					
					<table style="width:100%; ">
						<tr>
							<td>
								<label for="password">Enter Password : <span>*</span></label><br>
								<input type="password" name="password" placeholder="********" required><br>
							</td>
							
							<td>
								<label for="password">Confirm Password : <span>*</span></label><br>
								<input type="password" name="password" placeholder="********" required><br>
							</td>
						</tr>

					</table>
					
					
					
					<input type="submit" value="Register" style="width:40%; float:right;">
				</form>
				<br><br><br><br>
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