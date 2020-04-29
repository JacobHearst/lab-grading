<html>
	<head>
		<title>Skills Checklist</title>
		<link rel="stylesheet" type="text/css" href="style_skills.css">
		<script src="add_skill.js" type="text/javascript"></script>
	</head>

	<body>
		<?php //Insert the skill into the database if the button was clicked and the post was set
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		$sectID = $_GET["sectionId"];
		$topic = $_POST["topic"];
		$notes = $_POST["notes"];
		
		$labID = $_GET["labId"];
		
		// This could be changed based on the logged in user
		$createdBy = "1";
		
		if (isset($_POST["add"])) {
			include "../database.php";
			
			$queryA = "INSERT INTO Skill (SectionId, Topic) VALUES (?, ?);";
			$paramsA = array();
			array_push($paramsA, "$sectID%", "$topic%");
			$resultA = execQuery($queryA, $paramsA);
			
			$queryB = "SELECT * FROM Skill WHERE Topic=? AND SectionId=?;";
			$paramsB = array();
			array_push($paramsB, "$topic%", "$sectID%");
			$resultB = execQuery($queryB);

			$skillID = $resultB[0];


			$queryC = "INERST INTO Notes (LabId, SkillId, CreatedBy, Note) VALUES (?, ?, ?, ?);";
			$paramsC = array();
			array_push($paramsC, "$labID%", "$skillID%", "$createdBy%", "$notes%");
			$resultC = execQuery($queryC);
			
		}
		?>
		
		<h1>Lab Grading Tool</h1>
		<h2>Programmed by: Agile Experience Group 4</h2>
		<h4><a href="../">Return to main page.</a></h4>
		
		<br>
		<hr>
		
		<h2>Skills Checklist for Section: <?php echo($_GET["sectionId"]); ?> Lab: <?php echo($_GET["labName"]); ?></h2>
		<p>View and Edit Skills:</p>
		
		<table>
			<tr>
				<th>Topic:</th>
				<th>Notes:</th>
			</tr>
			
			<?php
				// Call to the database using the section ID in the skills checklist table and return the information there.  
				// Then use it to build a form where you can add/update items on the skills checklist


			?>
			
			<tr>
				<td colspan="2"><input type="button" value="Save Changes" onClick="updateSkills()"></td>
			</tr>
		</table>
			
		<br>
			
		<h4>Add New Skill:</h4>
		
		<form action="skills.php?sectionId=<?php echo($_GET["sectionId"]); ?>" method="post">
			<input type="text" name="topic" placeholder="Topic" required>
			<input type="text" name="notes" placeholder="Notes" required>
			<input type="submit" value="Add Skill" name="add">
		</form>
	</body>
</html>
