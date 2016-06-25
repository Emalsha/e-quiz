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

		//check whether test are their same name
		$qry_to_check = "SELECT test_id FROM test WHERE admin_id='$admin_id' AND test_name='$testName'";
		$result = mysqli_query($conn,$qry_to_check);
		$num_of_row = mysqli_num_rows($result);

		if ($num_of_row>0) {
			$previous_test = mysqli_fetch_assoc($result);
			$previous_test = $previous_test['test_id'];

			echo "<script type='text/javascript'> alert('Sorry, you already have test created on this test name. Test id = $previous_test. Please create another test or use previous one.');</script>";
		}else{

			//insert data
			$query = "INSERT INTO test (admin_id,test_name,description) VALUES ('$admin_id','$testName','$testDesc')";

			$res = mysqli_query($conn,$query);

			if ($res == 1) {
				echo "<script type='text/javascript'> alert('You created test.You will get test id number.Pleae keep it with you.');</script>";

				//get test id and show it.
				$qry = "SELECT test_id FROM test WHERE admin_id='$admin_id' AND test_name='$testName'";
				$result = mysqli_query($conn,$qry);
				$rowData = mysqli_fetch_assoc($result);
				$test_id = $rowData['test_id'];
				$message = str_pad($test_id,6,0,STR_PAD_LEFT);
				$_SESSION['test_id'] = $test_id;
				$_SESSION['testName'] = $testName;

			}else{
				echo "<script type='text/javascript'> alert('$res');</script>";
			}
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
				<p style="font-size: .6em; color: #727272;">Administrator > Home</p>
				<center><h1>Welcome to E-quiz</h1></center>	
				<p style="align:justify;">E-qize is a online question generator service.You can create online question paper and publis it to others.</p>
				<p style="align:justify;">In here you can create test and add questions.After finalyze your test you can publish it to your studends.</p>
			</div>	
			
			<div class="block">
				<form action="" method="post">
					<table style="margin: auto;">
						<tr>
							<td><label for="testName">Test name :</label></td>
							<td><input type="text" name="testName" placeholder="ex: Software Engineering quiz." style="width: 100%;" required></td>
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
					echo "<center><p style='font-size:0.8em;'>Created test id show below.Please remember it for further process.</p></center>";
					echo "<center> <h3> $message </h3> </center> ";
					echo "</div>";
				}
			 ?>
		
		</div>
	</div>
</body>
</html>