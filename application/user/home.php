<?php 
	
	require_once("../database/db.conf");
	session_start();
	
	if (!isset($_SESSION['login_user'])) {
		header("location:user_login.php");
		exit();
	}

	$user = $_SESSION['login_user'];

	if (isset($_POST['search']) & isset($_POST['testName'])) {

		$testName = mysqli_real_escape_string($conn,$_POST['testName']);

		$qry_to_check = " SELECT test_id,test_name,description FROM test WHERE (test_name='$testName' OR test_id = '$testName') ";

		$result = mysqli_query($conn,$qry_to_check);
		$num_of_row = mysqli_num_rows($result);

			
		if ($num_of_row == 1) {
			$test_result = mysqli_fetch_assoc($result);
			$_SESSION['testName'] = $test_result['test_name'];
			$_SESSION['test_id'] = $test_result['test_id'];
			$_SESSION['description'] = $test_result['description'];
			$_SESSION['test_start'] = false;
 			header("location:question.php");
		}else if($num_of_row > 1){
			echo "<script type='text/javascript'> alert('Sorry, There are many test in same name. Please use test id given by your teacher.');</script>";
		}else{
			echo "<script type='text/javascript'> alert('Sorry, Not found test.');</script>";
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
	
	<?php include("../includes/header.php"); ?>
	<?php require("../includes/user_nav.php"); ?>


	<div class="container">
		<div class="container-inside">
			<div class="block">
				<p style="font-size: .6em; color: #727272;">User > Home </p>
				<center><h3>Home</h3></center>	
				<h1>Welcome to e-quiz</h1>
				<p>First you have to select Test.<br>Search Test Name or Test ID given by your teacher.</p>
			</div>	

			

			<div class="block_bordered">
				<form action="" method="post">
					<table style="margin: auto; width: 100% ;" id="tbl" >
						<tr>
							<td><label for="testName" style="font-size: .8em;">Search Test :</label></td>
							<td><input type="text" name="testName" placeholder="Test Name or Test Id" style="width: 90%;" required></td>
							<td><input type="submit" name="search" value="Search" ></td>
						</tr>
					</table>	
				</form>
			</div>	
		</div>
	</div>
</body>
</html>

			
