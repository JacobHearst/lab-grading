<html>
	<head>
		<title>Lab Search</title>
		<style>
			body {
				background-color: #C1FFF6;
			}
			
			h1, h2, h4 {
				text-align: center;
			}
			
			input[type=text] {
				width: 80%;
				padding: 12px 20px;
				margin: 8px 0;
				box-sizing: border-box;
			}

			select {
				padding: 12px 20px;
				border: none;
				border-radius: 4px;
				background-color: #f1f1f1;
			}

			input[type=submit] {
				background-color: #f1f1f1;
				border: none;
				color: black;
				padding: 12px 32px;
				text-decoration: none;
				margin: 8px 2px;
				cursor: pointer;
			}
			
			table {
				margin-left: auto;
				margin-right: auto;
			}
			
			table, th, td {
				border-collapse: collapse;
				padding: 4px;
				border: 1px solid black;
				text-align: center;
			}
			
			h3 {
				text-align: center;
				font-weight: bold;
			}
		</style>
	</head>
	
	<body>
		<h1>Lab Grading Tool</h1>
		<h2>Programmed by: Agile Experience Group 4</h2>
		<h4><a href="../">Return to main page.</a></h4>
		
		<br>
		<hr>
		
		<h2>Search For Lab:</h2>
		
		<?php
			$searchTerm = $_POST["search"];
			$searchType = $_POST["searchType"]
		?>
		
		<form action="search.php" method="post">
			<select name="searchType" size="1">
				<?php if($searchType == "none") {
					echo ("<option selected value='none'>Search by...</option>");
					echo ("<option value='LabName'>Lab Name</option>");
					echo ("<option value='StudentName'>Student Name</option>");
					echo ("<option value='Professor'>Professor</option>");
					echo ("<option value='Course'>Course</option>");
				} elseif ($searchType == "LabName") {
					echo ("<option value='none'>Search by...</option>");
					echo ("<option selected value='LabName'>Lab Name</option>");
					echo ("<option value='StudentName'>Student Name</option>");
					echo ("<option value='Professor'>Professor</option>");
					echo ("<option value='Course'>Course</option>");
				} elseif ($searchType == "StudentName") {
					echo ("<option value='none'>Search by...</option>");
					echo ("<option value='LabName'>Lab Name</option>");
					echo ("<option selected value='StudentName'>Student Name</option>");
					echo ("<option value='Professor'>Professor</option>");
					echo ("<option value='Course'>Course</option>");
				} elseif ($searchType == "Professor") {
					echo ("<option value='none'>Search by...</option>");
					echo ("<option value='LabName'>Lab Name</option>");
					echo ("<option value='StudentName'>Student Name</option>");
					echo ("<option selected value='Professor'>Professor</option>");
					echo ("<option value='Course'>Course</option>");
				} elseif ($searchType == "Course") {
					echo ("<option value='none'>Search by...</option>");
					echo ("<option value='LabName'>Lab Name</option>");
					echo ("<option value='StudentName'>Student Name</option>");
					echo ("<option value='Professor'>Professor</option>");
					echo ("<option selected value='Course'>Course</option>");
				}
				?>
			</select>

			<input type="text" name="search" value="<?php echo $searchTerm; ?>">

			<input type="submit" value="Submit">
		</form>
			
		<br>
		<hr>
		
		<?php 
		//DO THE SEARCH TO THE DATABASE HERE USING THE $searchTerm and $searchType 
		//Save the results of the query into $results 
		?>
		
		<table>
			<tr>
				<th>ID:</th>
				<th>Name:</th>
				<th>Description:</th>
				<th>Due Date:</th>
				<th>Score:</th>
				<th>Section ID:</th>
			</tr>
			
			<?php
			//Check if the results returned 0 rows (needs to be tested!!!)
			if (mysql_num_rows($result) == 0) {
				echo ("<h3>NO RESULTS FOUND!</h3>");
			} else {
				while($row = mysql_fetch_array($result)) {
					// This will loop through each row
					$id = $row["id"];
					$name = $row["name"];
					$description = $row["description"];
					$dueDate = $row["dueDate"];
					$score = $row["score"];
					$sectionID = $row["sectionId"];
					
					echo "<tr>";
					
					echo "<td>$id</td>";
					echo "<td>$name</td>";
					echo "<td>$description</td>";
					echo "<td>$dueDate</td>";
					echo "<td>$score</td>";
					echo "<td>$sectionID</td>";
					
					echo "</tr>";
				}
			}
			?>
		</table>
	
	</body>
</html>