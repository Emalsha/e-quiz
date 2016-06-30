<?php 
	
	require_once("../database/db.conf");
	session_start();
	
	if (!isset($_SESSION['login_admin'])) {
		header("location:login.php");
		exit();
	}

	$descript = "";

	$user = $_SESSION['login_admin'];

	if (isset($_POST['search'])) {
		searchTest();
	}

	function searchTest(){
		
		$testName = mysqli_real_escape_string($conn,$_POST['testName']);
		$admin_id = $_SESSION['admin_id'];

		$qry_to_check = "SELECT test_id,test_name,description FROM test WHERE admin_id='$admin_id' AND (test_name='$testName' OR test_id = '$testName')";
		echo "<script type='text/javascript'> alert('$qry_to_check')</script>";
		$result = mysqli_query($conn,$qry_to_check);
		$num_of_row = mysqli_num_rows($result);

			
		if ($num_of_row>0) {
			$test_result = mysqli_fetch_assoc($result);
			$descript = $test_result['description']; 
			echo "<script type='text/javascript'> alert('ekk hri')</script>";			
		}else{
			$descript = "No Test found.";

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
					<table style="margin: auto;width: 100% " >
						<tr>
							<td><label for="testName" style="font-size: .8em;">Search Test :</label></td>
							<td><input type="text" name="testName" placeholder="Test Name or Test Id" style="width: 90%;" required></td>
							<td><input type="submit" name="search" value="Search" ></td>
						</tr>

						<tr>
							<td colspan="3">
								<label for="testDesc" style="font-size: .8em;">
									<?php 
										if ($descript != "") {
											echo 'Description : '.$descript;	
										}
									?> 
								</label>
							</td>
						</tr>
					</table>	
				</form>
			</div>		
		</div>
	</div>
</body>
</html>