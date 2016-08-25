<?php 
	
	require_once("../database/db.conf");
	session_start();

	if (!isset($_SESSION['login_admin'])) {
		header("location:login.php");
		exit();
	}

	$user = $_SESSION['login_admin'];
	$testName = $_SESSION['testName'];
	$test_id = $_SESSION['test_id'];
	$admin_id = $_SESSION['admin_id'];

	function getResults(){
		$qry = 'SELECT * FROM results WHERE test_id='.$test_id;
		$results  = mysqli_query($conn,$qry);
		while ($row = mysqli_fetch_assoc($results)) {
			$u_id = $row["user_id"];
			$qryToUser = "SELECT fname FROM users WHERE user_id = ".$u_id;
			$u_name = mysqli_fetch_assoc(mysqli_query($conn,$qryToUser))["fname"];
			$u_marks = $row["marks"];
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
				<p style="font-size: .6em; color: #727272;">Administrator > Home > Question > Setting > Report</p>
				<center><h2>Report</h2></center>
			</div>	
			
			<div class="">
				<dl>
				  <dt>
				    Students Results for <?php echo $testName?>
 				  </dt>
				  <dd class="percentage percentage-45"><span class="text">Emalsha: 45%</span></dd>
				  <dd class="percentage percentage-68"><span class="text">Nuwan: 68%</span></dd>
				  <dd class="percentage percentage-71"><span class="text">Chathura: 71%</span></dd>
				  <dd class="percentage percentage-70"><span class="text">Shavindra: 70%</span></dd>
				  <dd class="percentage percentage-65"><span class="text">Dharshika: 65%</span></dd>
				  <dd class="percentage percentage-59"><span class="text">Namal: 59%</span></dd>
				</dl>
			</div>

		</div>
	</div>
</body>
</html>
