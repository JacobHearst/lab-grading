<?php

	$lab_id = $_REQUEST["labID"];
	$user_id = $_REQUEST["studentID"];
	$lab_name = $_REQUEST["labName"];
	$student_first_name = $_REQUEST["studentFirstName"];
	$student_last_name = $_REQUEST["studentLastName"];
	$section_id = $_REQUEST["sectionID"];
	$servername = "144.13.22.59:3306";
	$database = "G4AgileExperience";
	$username = "g4AppUser";
	$password = "aug4";

?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Grade Lab (Single Value)</title>
		<link rel="stylesheet" type="text/css" href="../www/GradeLab/grade_style.css">
		<script src="../www/GradeLab/grade_single_value.js" type="text/javascript">
		</script>
	</head>

	<body>
		<h1>Grade Lab (Single Value)</h1>
		<h2>Lab Name: <?=$lab_name?></h2>
		<h2>Student Name: <?=$student_last_name?>, <?=$student_first_name?></h2>
		<h2>Section ID: <?=$section_id?></h2>
		<form name="gradeScore">
			<fieldset>
				<label for="score">Enter lab score: </label><br>
				<input type="text" id="score" name="score">
				<button type="button" onClick="submitForm()">Submit</button>
			</fieldset>
		</form>
	</body>
</html>