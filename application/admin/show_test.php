<?php 
	
	require_once("../database/db.conf");
	session_start();
	
	if (!isset($_SESSION['login_admin'])) {
		header("location:login.php");
		exit();
	}

	$user = $_SESSION['login_admin'];

	$test_id = $_SESSION['test_id'];
	$qry_to_check = " SELECT question,marks FROM question WHERE test_id='$test_id'";

	$result = mysqli_query($conn,$qry_to_check);

	/*echo '<script type="text/javascript" > console.log("'.$qry_to_check.'");</script>';*/
	$qcount =0;


	if (isset($_GET['delete'])) {
		$delete_qry = "DELETE FROM test WHERE test_id='$test_id' ";
		$res = mysqli_query($conn,$delete_qry);
		$row_count = mysqli_num_rows($res);
		if ($row_count>0) {
			echo "<script type='text/javascript'> alert('Test removed succesfully.');</script>";
			header("location:setting.php");
		}

	}else if(isset($_GET['add_q'])){
		header("location:question.php");
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
				<form action="setting.php" method="post">
					<table style="margin: auto; width: 100% ;" id="tbl" >
						<tr>
							<td><label for="testName" style="font-size: .8em;">Search Test :</label></td>
							<td><input type="text" name="testName" placeholder="Test Name or Test Id" style="width: 90%;" required></td>
							<td><input type="submit" name="search" value="Search" ></td>
						</tr>
					</table>	
				</form>
			</div>	
			
			<div class="block_bordered" >
					<table style="margin: auto; width: 100%; " id="qtbl" class="strip_table"> 
						<tr>
							<th colspan="3" >Test Name : <?php echo $_SESSION['testName']; ?></th>
						</tr>
						<tr>
							<td></td>
							<td>Question</td>
							<td><center>Marks</center></td>
						</tr>

						<?php 

						while ($row = mysqli_fetch_assoc($result)) {
							$qcount++;
							echo 	'<tr>';
							echo	'<td><center>'.$qcount.'</center></td>';
							echo	'<td>'.$row["question"].'</td>';
							echo	'<td><center>'.$row["marks"].'</cneter></td>';
							echo	'</tr>';
						
						}

						 ?>

					</table>
			</div>

			<div class="block">
				<form action="" method="get">
					<table style="width: 100%; ">
						<tr>
							<td><center><input type="submit" name="delete" value="Delete Test" onclick="return confirm('Are you sure ?');"></center></td>
							<td><center><input type="submit" name="add_q" value="Add Question"></center></td>
						</tr>
					</table>
					
					
				</form>
			</div>

		</div>
	</div>
</body>
</html>