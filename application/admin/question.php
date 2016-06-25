<?php 
	
	require_once("../database/db.conf");
	session_start();

	if (!isset($_SESSION['login_admin'])) {
		header("location:login.php");
		exit();
	}

	if (!isset($_SESSION['testName'])) {
		
		echo "<script type='text/javascript'> alert('Sorry, First create test.Then you can add questoin. If you want add questin to created test please go to settings and select test.');</script>";		
	}

	$user = $_SESSION['login_admin'];
	$testName = $_SESSION['testName'];
	$test_id = $_SESSION['test_id'];
	$admin_id = $_SESSION['admin_id'];

	if (!isset($_POST['testName'])) {
		echo "<script type='text/javascript'> alert('Sorry, First create test.Then you can add questoin. If you want add questin to created test please go to settings and select test.');</script>";
		//header("location:home.php");
	}else{
		
		$question = mysqli_real_escape_string($conn,$_POST['question']);
		$answer = $_POST['correct_ans'];
		$marks = $_POST['marks'];
	
		//insert question
		$query = "INSERT INTO question (test_id,question,correct_answer,marks) VALUES ('$test_id','$question','$answer','$marks')";

		$res = mysqli_query($conn,$query);

		if ($res == 1) {
			/*echo "<script type='text/javascript'> alert('You entered question succesfully.');</script>";
*/
			//get question id and enter answers.
			$qry = "SELECT qid FROM question WHERE test_id='$test_id' AND question='$question'";
			$result = mysqli_query($conn,$qry);
			$rowData = mysqli_fetch_assoc($result);
			$qid = $rowData['qid'];

			$query = "INSERT INTO answers(qid,answer_num,answer) VALUES ('$qid','','')"

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

	<script type="text/javascript">
		function change() {

			var type = document.quesForm.qtype;
			var tbl = document.getElementById("tbl"); // select table node


			if (type.value == 2) {
				console.log('T & F');
		
				//clear table
				while (tbl.lastChild) {	
					tbl.removeChild(tbl.lastChild);
				}

				var tr = tbl.insertRow(0);
				tr.insertCell(0).innerHTML = '<label for="ans01">Answer 01.</label>';
				tr.insertCell(1).innerHTML = '<center>True</center>';
				tr.insertCell(2).innerHTML = '<label><input type="radio" name="correct_ans" value="1"> Correct Answer</label>';
				
				//=================================================================
				
				var tr = tbl.insertRow(1);
				tr.insertCell(0).innerHTML = '<label for="ans02">Answer 02.</label>';
				tr.insertCell(1).innerHTML = '<center>False</center>';
				tr.insertCell(2).innerHTML = '<label><input type="radio" name="correct_ans" value="2"> Correct Answer</label>';


			/*	<td><center>True</center></td>
				<td style="width: 50%;"><label><input type="radio" name="correct_ans" value=""> Correct Answer</label></td>
			*/

			}else if (type.value == 4) {
				console.log('MCQ');

				//clear table
				while (tbl.lastChild) {	
					tbl.removeChild(tbl.lastChild);
				}

				for (var i = 1; i <= 4; i++) {
					var tr = tbl.insertRow(i-1); //add table row
				
					tr.insertCell(0).innerHTML = '<label for="ans0'+i+'">Answer 0'+i+'.</label>'; //add table detail
					tr.insertCell(1).innerHTML = '<input type="text" name="ans0'+i+'" style="width: 100%;">';
					tr.insertCell(2).innerHTML = '<label><input type="radio" name="correct_ans" value="'+i+'"> Correct Answer</label>';
				}
				
			  /*<td><label for="ans01">Answer 01.</label></td>
				<td><input type="text" name="ans01" style="width: 100%;"></td>
				<td><label><input type="radio" name="correct_ans" value=""> Correct Answer</label></td>*/
			}
		}

	</script>



</head>
<body>
	
	<?php 
		include("../includes/header.php");
		require("../includes/admin_nav.php");
	 ?>



	<div class="container">
		<div class="container-inside">
			
			<div class="block">
				<p style="font-size: .6em; color: #727272;">Administrator > Home > Question</p>
				<center><h2>Add questions.</h2></center>
			</div>	
			
			<div class="block">
				<form action="" method="post" name="quesForm">
					
					<!-- question type selection -->
					<center>
					<label >Question type : </label><br><br>
					<label style="font-size:1em;"> T & F <input type="radio" name="qtype" id="qtype" value="2" onchange="change()"> | </label>
					<label style="font-size: 1em;"><input type="radio" name="qtype" id="qtype" value="4" onchange="change()"> MCQ </label>
					</center>

					<!-- question getting tabel -->
					<table style="margin: auto;font-size: .9em; width: 100%; ">
						<tr>
							<td><label for="question">Question :</label></td>
						</tr>
						<tr>							
							<td colspan="2"><input type="text" name="question" style="width: 100%;" required></td>
						</tr>
						<!-- _________________________________________________________________________________________________ -->

					</table>

					<!-- answer entering table -->
					<table style="margin: auto;font-size: .9em; width: 100%;" id="tbl" name="tbl">
						<tr><td>
							<center><label>First select question type.</label></center>
						</td></tr>
					</table>

					<!-- submit button table -->
					<table style="margin: auto;font-size: .9em; width: 100%;">
						<tr>
							<td colspan="2">
							<?php 
							if($testName!=""){
								echo "<p>You adding question to \"$testName \" and test id : $test_id </p>";
							}
							?>
							</td>
						</tr>
						<tr>
							<td>
								<center>
									Marks for this question :<input type="number" name="marks" min="1" max="25" required>
								</center>
							</td>
							<td style="width:50%;"><input type="submit" name="submit" value="Add Question" style="float: right;"></td>
						</tr>
					</table>	

				</form>
			</div>

		</div>
	</div>
</body>
</html>

<!-- 	<tr>
			<td><label for="ans01">Answer 01.</label></td>
			<td><input type="text" name="ans01" style="width: 100%;"></td>
			<td><label><input type="radio" name="correct_ans" value=""> Correct Answer</label></td>
		</tr> -->
		
		<!-- <tr>
			<td><center>True</center></td>
			<td style="width: 50%;"><label><input type="radio" name="correct_ans" value=""> Correct Answer</label></td>
		</tr>
		
		<tr>
			<td><center>False</center></td>
			<td><label><input type="radio" name="correct_ans" value=""> Correct Answer</label></td>
		</tr> -->