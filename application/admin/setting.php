<?php 
	
	require_once("../database/db.conf");
	session_start();
	
	if (!isset($_SESSION['login_admin'])) {
		header("location:login.php");
		exit();
	}

	$user = $_SESSION['login_admin'];

	if (isset($_POST['search']) & isset($_POST['testName'])) {
		searchTest();
	}

	function searchTest(){

		if (!$conn) {
			require("../database/db.conf");
		}

		$testName = mysqli_real_escape_string($conn,$_POST['testName']);
		$admin_id = $_SESSION['admin_id'];

		$qry_to_check = " SELECT test_id,test_name,description FROM test WHERE admin_id='$admin_id' AND (test_name='$testName' OR test_id = '$testName') ";

		$result = mysqli_query($conn,$qry_to_check);
		$num_of_row = mysqli_num_rows($result);

			
		if ($num_of_row>0) {
			$test_result = mysqli_fetch_assoc($result);
			$_SESSION['testName'] = $test_result['test_name'];
			$_SESSION['test_id'] = $test_result['test_id'];
			header("location:show_test.php");
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
	
	<?php 
		include("../includes/header.php");
		require("../includes/admin_nav.php");
	 ?>

	<div class="container">
		<div class="container-inside">
			
			<div class="block">
				<p style="font-size: .6em; color: #727272;">Administrator > Home > Question > Setting</p>
				<center><h3>Settings</h3></center>	
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