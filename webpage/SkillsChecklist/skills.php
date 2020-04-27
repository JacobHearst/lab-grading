<html>
	<head>
		<title>Skills Checklist</title>
		<link rel="stylesheet" type="text/css" href="style_skills.css">
		<script src="add_skill.js" type="text/javascript"></script>
	</head>

	<body>
		<h1>Lab Grading Tool</h1>
		<h2>Programmed by: Agile Experience Group 4</h2>
		<h4><a href="../">Return to main page.</a></h4>
		
		<br>
		<hr>
		
		<h2>Skills Checklist for Section: <?php echo($_GET["sectionId"]); ?></h2>
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
		
		<form onSubmit="addSkill()">
			<input type="text" name="topic" placeholder="Topic" required>
			<input type="text" name="notes" placeholder="Notes" required>
			<input type="button" value="Add Skill">
		</form>
	</body>
</html>
