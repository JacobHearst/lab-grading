<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $lab_id = $_REQUEST["labID"];
  $student_first_name = $_REQUEST["studentFirstName"];
  $student_last_name = $_REQUEST["studentLastName"];
  $grade = $_REQUEST["grade"];
  $servername = "144.13.22.59:3306";
  $database = "G4AgileExperience";
  $username = "g4AppUser";
  $password = "aug4";

  $params = array();

  include "../database.php";

  $conn = getConnection();

  //Query to select student ID

  $statement = $conn -> prepare("SELECT Id FROM G4AgileExperience.User WHERE FirstName=? AND LastName=?");
  $statement -> bindParam(1, $student_first_name, PDO::PARAM_STR);
  $statement -> bindParam(2, $student_last_name, PDO::PARAM_STR);
  $statement -> execute();
  $row = $statement->fetch(PDO::FETCH_ASSOC);
  $student_id = $row['Id'];

  //Query to select lab name

  $statement = $conn -> prepare("SELECT Name FROM G4AgileExperience.Lab WHERE Id=?");
  $statement -> bindParam(1, $lab_id, PDO::PARAM_STR);
  $statement -> execute();
  $row = $statement->fetch(PDO::FETCH_ASSOC);
  $lab_name = $row['Name'];

  //Query to update lab score

  $statement = $conn -> prepare("UPDATE Grade SET Score = ? WHERE LabId = ? AND UserId = ?");
  $statement -> bindParam(1, $grade, PDO::PARAM_STR);
  $statement -> bindParam(2, $lab_id, PDO::PARAM_STR);
  $statement -> bindParam(3, $student_id, PDO::PARAM_STR);
  $statement -> execute();

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Grade Lab</title>
    <link rel="stylesheet" type="text/css" href="../GradeLab/grade_style.css">
    <script src="grade_single_value.js" type="text/javascript">
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
    <h3>Lab Name: <?=$lab_name?> (ID: <?=$lab_id?>)</h3>
    <h3>Current Grade: <?=$grade?></h3>	
    
    <form name="gradeForm" method="post" onSubmit="return validateForm()" action="/grade_single_value.php?
    labID=<?=$lab_id?>&studentFirstName=<?=$student_first_name?>&studentLastName=<?$student_last_name?>">
      <fieldset>
        
        <label for="grade">Lab score: </label>
        <input type="text" id="grade" name="grade"><br>
        
        <button type="submit" value="Submit">Save and Update</button>
      </fieldset>
    </form>
  </body>
</html>
