<html>
	<head>
		<title>Skills Checklist</title>
		<style>
			body {
				background-color: #C1FFF6;
			}
			
			h1, h2, h4 {
				text-align: center;
			}
		</style>
	</head>

	<body>
		<h1>Lab Grading Tool</h1>
		<h2>Programmed by: Agile Experience Group 4</h2>
		<h4><a href="../">Return to main page.</a></h4>
		
		<br>
		<hr>
		
		<h2>Skills Checklist for Section: <?php echo($_GET["sectionId"]); ?></h2>
		
		<br>
		
		<form action="" method="post">
			<?php
			// Call to the database using the section ID in the skills checklist table and return the information there.  
			// Then use it to build a form where you can add/update items on the skills checklist
			?>
			<p>Create a form here</p>
			
			<input type="submit" value="Submit">
		</form>
		
	</body>
</html>
