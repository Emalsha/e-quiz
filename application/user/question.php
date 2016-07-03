<?php 
	
	require_once("../database/db.conf");
	session_start();
	
	if (!isset($_SESSION['login_user'])) {
		header("location:user_login.php");
		exit();
	}

	$user = $_SESSION['login_user'];
	$testName = $_SESSION['testName'];
	$test_id = $_SESSION['test_id'];
	$description = $_SESSION['description'];
	$min_num_of_ques = 1; //Can decide how manyquestino need.
			
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>e-quiz</title>
	<link rel="stylesheet" href="../../public/css/e-quiz.css">
</head>
<body>
	
	<?php include("../includes/header.php"); ?>
	<?php require("../includes/user_nav.php"); ?>


	<div class="container">
		<div class="container-inside">
			
			<div class="block">
				<p style="font-size: .6em; color: #727272;">User > Home > Question </p>
				<center><h3>Questions</h3></center>	
				<p>You facing <?php echo $testName ?> - <?php echo $description; ?>.</p>
				<p>Answer all the question.</p>
				<?php //check test start
					if (!$_SESSION['test_start']) {
						echo   '<form action="" method="post">
									<center> <input type="submit" name="start" value="Enroll Test" style="width: 50%;" ></center>	
								</form>';	
					}
				?>
			</div>	

<?php
			
	if (isset($_POST['start']) & isset($_SESSION['testName'])) {

		$query = " SELECT qid,question,correct_answer,marks FROM question WHERE test_id = $test_id ";

		$result = mysqli_query($conn,$query);
		$num_of_row = mysqli_num_rows($result);

		if ($num_of_row < $min_num_of_ques) {
			echo "<script type='text/javascript'> alert('Sorry, Selected test haven\'t enough Questions.');</script>";
			header("location:home.php");
		}else{ 
			$_SESSION['test_start'] = true;
				
			//Show question in container
			$count = 0;
			while ($row = mysqli_fetch_assoc($result)) {
				$count++;
				echo 	'<div class="block_bordered">
							<table style="margin: auto; width: 100% ;" id="tbl">';
				echo 	'	<tr>
								<td style="width: 8% ;" >'.$count.'</td>
								<td>'.$row["question"].'</td> 
								<td style="width: 8% ; font-size:.7em;">Marks '.$row["marks"].'</td> 
							</tr>';

				$correct_answer = $row['correct_answer'];
				$qid = $row['qid'];
				$get_answer_qry = 'SELECT answer_num,answer FROM answers WHERE qid='.$qid;
				$res = mysqli_query($conn,$get_answer_qry);

				//Show answers in table
				while ($ans_row = mysqli_fetch_assoc($res)) {
					echo 	'	<tr>
								<td style="width: 8% ;" ></td>
								<td><label>'.$ans_row["answer_num"].' . '
									 .$ans_row["answer"]
									 .' <input type="radio" name="'.$qid.'q" value="'.$ans_row["answer_num"].'" required> </label> </td> 
								<td style="width: 8% ;"></td> 
							</tr>';
				}

				echo	'	</table>
						</div>';
			}	
		}
	}
	
			
?>

 
		</div>
	</div>
</body>
</html>
