<?php

	$lab_id = $_REQUEST["labID"];
	$student_first_name = $_REQUEST["studentFirstName"];
	$student_last_name = $_REQUEST["studentLastName"];
	$grade = $_REQUEST["grade"];
	$servername = "144.13.22.59:3306";
	$database = "G4AgileExperience";
	$username = "g4AppUser";
	$password = "aug4";

	$student_id = array();
	$lab_name = array();

	$conn = mysqli_connect($servername,$username,$password,$database);
		if (!$conn) {
			die ("Connection Failed: " . mysqli_connect_error());
		}

	//Query to select student ID

	$sql = "SELECT Id FROM User WHERE FirstName=$student_first_name AND LastName=$student_last_name";

	$results = mysqli_query($conn,$sql);
	if(!$results) {
		$error = mysqli_error();
		echo $error;
	}

	while($row=mysqli_fetch_array($results)){
		array_push($student_id, $row);
	}

	//Query to select lab name

	$sql = "SELECT Name FROM Lab WHERE Id=$lab_id";

	$results = mysqli_query($conn,$sql);
	if(!results) {
		$error = mysqli_error();
		echo $error;
	}

	while($row=mysqli_fetch_array()) {
		array_push($lab_name, $row);
	}

	//Query to update lab score

	$sql = "UPDATE Grade SET Score = $grade WHERE LabId = $lab_id AND UserId = $student_id[0]";

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
		<title>Grade Lab</title>
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
		
		<h2>Grade Lab</h2>
		<h3>Student Name: <?=$student_last_name?>, <?=$student_first_name?> (ID: <?=$student_id?>)</h3>
		<h3>Lab Name: <?=$lab_name[0]?> (ID: <?=$lab_id?>)</h3>
		<h3>Current Grade: <?=$grade?></h3>	
		
		<form name="gradeForm" method="post" action="/grade_single_value.php?
		labID=<?=$lab_id?>&studentFirstName=<?=$student_first_name?>&studentLastName=<?$student_last_name?>">
			<fieldset>
				
				<label for="grade">Lab score: </label>
				<input type="text" id="grade" name="grade"><br>
				
				<button type="button" onClick="submitForm()">Save and Update</button>
			</fieldset>
		</form>
	</body>
</html>