<?php
	include "../database.php";

	$section_id = $_GET["section_id"];
	$lab_id = $_GET["lab_id"];
	$lab_name = $_GET["lab_name"]
?>

<!doctype html>
<html lang="en">
	<head>
		<title>Lab : <?=$lab_name?></title>
			<link rel="stylesheet" type="text/css" href="./lab.css">
		</script>
	</head>

	<body>
		<h1>Lab Grading Tool</h1>
        <h2>Programmed by: Agile Experience Group 4</h2>
        <h4><a href="../../webpage">Return to main page.</a></h4>
        
        <br>
        <hr>
		
		<h1>Lab : <i><?=$lab_name?></i></h1>
		
		<?php
		$queryNotes = "SELECT Note
FROM G4AgileExperience.Lab 
JOIN G4AgileExperience.Notes ON G4AgileExperience.Lab.Id = Notes.LabId
WHERE LabId = 3;";
		$paramsQ = array();
		$resultQ = execQuery($queryNotes, $paramsQ);
		
		echo "<h3>Notes</h3>";
		foreach ($resultQ as $i => $row) {
			$note = $row["Note"];
			
			echo "<p>$note</p>";
		}
		
		$query = "SELECT FirstName, LastName, Score
		FROM G4AgileExperience.UserSection 
		JOIN G4AgileExperience.User ON G4AgileExperience.UserSection.UserId = User.Id
		JOIN G4AgileExperience.Grade ON G4AgileExperience.UserSection.UserId = Grade.UserId WHERE LabId = $lab_id and SectionId = $section_id;";
		$params = array();
		$result = execQuery($query, $params);

		echo "<table>";
		echo "<tr>
				<th>Name</th>
				<th>Grade</th>
			  </tr>";
		foreach ($result as $i => $row) {
			$first = $row["FirstName"];
			$last = $row["LastName"];
			$score = $row["Score"];
			
			echo "<tr>
					<td>$first $last</td>
					<td>$score</td>
            	</tr>";
		}
            echo "</table>";

			echo "<br></br>";

		$queryB = "SELECT FirstName, LastName
					FROM G4AgileExperience.UserSection 
					JOIN G4AgileExperience.User ON G4AgileExperience.UserSection.UserId = User.Id
					WHERE SectionId = $section_id;";
		$paramsB = array();
		$resultB = execQuery($queryB, $paramsB);

		echo "<table>";
		echo "<tr>
				<th>Name</th>
				<th>Grade</th>
			  </tr>";
		foreach ($resultB as $i => $row) {
			$first = $row["FirstName"];
			$last = $row["LastName"];
			
			echo "<tr>
					<td>$first $last</td>
					<td><a href='../GradeLab/grade_single_value.php?labID=$lab_id&studentFirstName=$first&studentLastName=$last&grade=$score'>Modify</a></td>
            	</tr>";
		}
            echo "</table>";



		$queryR = "SELECT Note, PointValue
					FROM G4AgileExperience.Rubric
					WHERE LabId = $lab_id;";
		$paramsR = array();
		$resultR = execQuery($queryR, $paramsR);

		echo "<table>";
		echo "<tr>
				<th>Note</th>
				<th>Points</th>
			  </tr>";
		foreach ($resultR as $i => $row) {
			$note = $row["Note"];
			$pointValue = $row["PointValue"];
			
			echo "<tr>
					<td>$note</td>
					<td>$pointValue</td>
            	</tr>";
		}
            echo "</table>";
		?>
			</fieldset>
		</form>
	</body>
	
</html>