<?php
	include "../database.php";

	$lab_id = $_GET["lab_id"];
	$lab_name = $_GET["lab_name"]
//	$student_id = $_GET["studentID"];
//	$grade = 100;

//	$sql = "UPDATE Grade SET Score = $grade WHERE LabId = $lab_id AND UserId = $student_id";

//	$results = mysqli_query($conn,$sql);
//	if(!$results) {
//		$error = mysqli_error();
//		echo $error;
//	}
//
//	mysqli_close();

?>

<!doctype html>
<html lang="en">
	<head>
		<title>Lab : <?=$lab_name?></title>
		<link rel="stylesheet" type="text/css" href="./grade_style.css">
		<script src="./grade_single_value.js" type="text/javascript">
		</script>
	</head>

	<body>
		<h1>Lab Grading Tool</h1>
        <h2>Programmed by: Agile Experience Group 4</h2>
        <h4><a href="../">Return to main page.</a></h4>
        
        <br>
        <hr>
		
		<h2>Lab : <i><?=$lab_name?></i></h2>
<!--		<h3>Current Grade: <?=$grade?></h3>-->
		<form name="studentForm" method="post">
			<fieldset>
				<?php
		$query = "SELECT UserId FROM UserSection";
		$params = array();
		$result = execQuery($query, $params);
		
		
		echo "<table>
            <tr>
                <th>ID: <?php $result ?></th>
                <th>Name:</th>
            </tr>";

            //Check if the results returned 0 rows
                foreach ($studentList as $i => $row) {
                    // This will loop through each row
                    $id = $row["Id"];
                    $name = $row["Name"];

                    echo "<tr>";
                    
                    echo "<td>$id</td>";
                    echo "<td><a href='../GradeLab/grade_single_value.php?lab_id=$id&lab_name=$name&section_id=$sectionID'>$name</a></td>";
                    
                    echo "</tr>";
                }
            echo "</table>";
		?>
				
				<label for="grade">Lab score: </label>
				<input type="text" id="grade" name="grade"><br>
				
				<button type="button" onClick="submitForm()">Save and Update</button>
			</fieldset>
		</form>
	</body>
	
</html>