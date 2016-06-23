<?php 
	
	require_once("../database/db.conf");
	session_start();
	$message = "";

	if (!isset($_SESSION['login_admin'])) {
		header("location:login.php");
		exit();
	}

	$user = $_SESSION['login_admin'];

	if (isset($_POST['submit'])) {
		
		$testName = mysqli_real_escape_string($conn,$_POST['testName']);
		$testDesc = mysqli_real_escape_string($conn,$_POST['testDesc']);
		$admin_id = $_SESSION['admin_id'];
		$message = $admin_id;

		$query = "INSERT INTO test (admin_id,test_name,description) VALUES ('$admin_id','$testName','$testDesc')";
		INSERT INTO test (admin_id,test_name,description) VALUES (1,"Sinhala",'mcq paper');

		$res = mysqli_query($conn,$query);

		if ($res == 1) {
			echo "<script type='text/javascript'> alert('You created test.You will get test id number.Pleae keep it with you.');</script>";
		}else{
			echo "<script type='text/javascript'> alert('$res');</script>";
		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-quiz - <?php echo $user; ?></title>
	<link rel="stylesheet" href="../../public/css/e-quiz.css">
</head>
<body>
	
	<?php 
		include("../includes/header.php");
		require("../includes/admin_nav.php");
	 ?>



	<div class="container">
		<div class="container-inside">
			
			<div class="block">
				
				<center><h1>Welcome to E-qize</h1></center>	
				<p style="align:justify;">E-qize is a online question generator service.You can create online question paper and publis it to others.</p>
				<p style="align:justify;">In here you can create test and add questions.After finalyze your test you can publish it to your studends.</p>
			</div>	
			
			<div class="block">
				<form action="" method="post">
					<table style="margin: auto;">
						<tr>
							<td><label for="testName">Test name :</label></td>
							<td><input type="text" name="testName" placeholder="ex: Software Engineering quiz." style="width: 100%;"></td>
						</tr>
						<tr>
							<td><label for="testDesc">Description :</label></td>
							<td><input type="text" name="testDesc" style="width: 100%;"></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="submit" value="Create Test" style="float: right;"></td></tr>
					</table>	
				</form>
			</div>


			<?php 
				if ($message !== "") {
					echo "<div class='block_bordered'>";
					echo "<center> <h3> $message </h3> </center> ";
					echo "</div>";
				}
			 ?>
		
		</div>
	</div>
</body>
</html>