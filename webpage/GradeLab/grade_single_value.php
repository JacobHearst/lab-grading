<?php

	$lab_id = $_REQUEST["labID"];
	$student_id = $_REQUEST["studentID"];
	$grade = $_REQUEST["grade"];
	$servername = "144.13.22.59:3306";
	$database = "G4AgileExperience";
	$username = "g4AppUser";
	$password = "aug4";

	$conn = mysqli_connect($servername,$username,$password,$database);
		if (!$conn) {
			die ("Connection Failed: " . mysqli_connect_error());
		}

	$sql = "UPDATE Grade SET Score = $grade WHERE LabId = $lab_id AND UserId = $student_id";

	$results = mysqli_query($conn,$sql);
	if(!$results) {
		$error = mysqli_error();
		echo $error;
	}

	mysqli_close();

?>

<!doctype html>
<html lang="en">
	<head>
		<title>Grade Lab (Single Value)</title>
		<link rel="stylesheet" type="text/css" href="../www/GradeLab/grade_style.css">
		<script src="../www/GradeLab/grade_single_value.js" type="text/javascript">
		</script>
	</head>

	<body>
		<h1>Lab Grading Tool</h1>
        <h2>Programmed by: Agile Experience Group 4</h2>
        <h4><a href="../">Return to main page.</a></h4>
        
        <br>
        <hr>
		
		<h2>Grade Lab (Single Value)</h2>
		<h3>Current Grade: <?=$grade?></h3>
		<form name="gradeForm" method="post">
			<fieldset>
				
				<label for="labID">Lab ID: </label>
				<input type="text" id="labID" name="labID" value=<?=$lab_id?>><br>
				
				<label for="studentID">Student ID: </label>
				<input type="text" id="studentID" name="studentID" value=<?=$student_id?>><br>
				
				<label for="grade">Lab score: </label>
				<input type="text" id="grade" name="grade"><br>
				
				<button type="button" onClick="submitForm()">Save and Update</button>
			</fieldset>
		</form>
	</body>
</html>