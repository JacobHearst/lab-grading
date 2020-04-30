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
		
		$labID = $_GET["labId"];
		
		$notice = "";
		
		// This could be changed based on the logged in user
		$createdBy = "1";
		
		if (isset($_POST["add"])) {
			include "../database.php";
			
			$topic = $_POST["topic"];
			$notes = $_POST["notes"];
			
			$conn = getConnection();
			
			// Query A
			$queryA = "INSERT INTO Skill (SectionId, Topic) VALUES (?, ?)";
			$stmt = $conn->prepare($queryA);
			$stmt->bindParam(1, $sectID, PDO::PARAM_STR);
			$stmt->bindParam(2, $topic, PDO::PARAM_STR);
			$stmt->execute();
			
			// Query B
			$stmt = $conn->prepare("SELECT * FROM Skill WHERE Topic=? AND SectionId=?");
			$stmt->bindParam(1, $topic, PDO::PARAM_STR);
			$stmt->bindParam(2, $sectID, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$skillId = $row['Id'];
			
			// Query C
			$queryC = "INSERT INTO Notes (LabId, SkillId, CreatedBy, Note) VALUES (?, ?, ?, ?)";
			$stmt = $conn->prepare($queryC);
			$stmt->bindParam(1, $labID, PDO::PARAM_STR);
			$stmt->bindParam(2, $skillId, PDO::PARAM_STR);
			$stmt->bindParam(3, $createdBy, PDO::PARAM_STR);
			$stmt->bindParam(4, $notes, PDO::PARAM_STR);
			$stmt->execute();
			
			$notice = "Skill: $topic added!";
		}
		?>
		
		<h1>Lab Grading Tool</h1>
		<h2>Programmed by: Agile Experience Group 4</h2>
		<h4><a href="../">Return to main page.</a></h4>
		
		<h4 class="notice"><?php echo($notice); ?></h4>
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
		
		<form action="skills.php?sectionId=<?php echo($_GET["sectionId"]); ?>&labId=<?php echo($_GET["labId"]); ?>&labName=<?php echo($_GET["labName"]); ?>" method="post">
			<input type="text" name="topic" placeholder="Topic" required>
			<input type="text" name="notes" placeholder="Notes" required>
			<input type="submit" value="Add Skill" name="add">
		</form>
	</body>
</html>
