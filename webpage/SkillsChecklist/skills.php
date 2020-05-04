<html>
  <head>
    <title>Skills Checklist</title>
    <link rel="stylesheet" type="text/css" href="style_skills.css">
  </head>

  <body>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include "../database.php";
    
    $sectID = $_GET["sectionId"];
    
    $labID = $_GET["labId"];
    
    $notice = "";
    
    // This could be changed based on the logged in user
    $createdBy = "1";
    
    if (isset($_POST["add"])) {
      
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
      
      $conn = null;
    }
    
    if (isset($_POST["update"])) {
      
      $updateSkillID = $_POST["skillID"];
      $updateSectionID = $_POST["sectionIDs"];
      $updateTopic = $_POST["topics"];
      $updateNote = $_POST["notes"];
      
      $conn = getConnection();
      
      foreach( $updateSkillID as $key => $value ) {
        //Iterate through each row and update them
        
        //Update the Skill Table First
        $updateSkillQuery = "UPDATE Skill SET Topic = ? WHERE Id = ? AND SectionId = ?";
        $stmt = $conn->prepare($updateSkillQuery);
        $stmt->bindParam(1, $updateTopic[$key], PDO::PARAM_STR);
        $stmt->bindParam(2, $value, PDO::PARAM_STR);
        $stmt->bindParam(3, $updateSectionID[$key], PDO::PARAM_STR);
        $stmt->execute();
        
        
        //Update the Notes Table Next
        $updateNotesQuery = "UPDATE Notes SET Note = ? WHERE SkillId = ?";
        $stmt = $conn->prepare($updateNotesQuery);
        $stmt->bindParam(1, $updateNote[$key], PDO::PARAM_STR);
        $stmt->bindParam(2, $value, PDO::PARAM_STR);
        $stmt->execute();
      }
      
      $notice = "Skills updated successfully!";
      
      $conn = null;
    }
    ?>
    
    <h1>Lab Grading Tool</h1>
    <h2>Programmed by: Agile Experience Group 4</h2>
    <h4><a href="../">Return to main page.</a></h4>
    
    <h4 class="notice"><?php echo($notice); ?></h4>
    <br>
    <hr>
    
    <h2>Skills Checklist for Section: <?php echo($_GET["sectionId"]); ?> Lab: <?php echo($_GET["labName"]); ?></h2>
    <h4>View and Edit Skills:</h4>
    
    <form action="skills.php?sectionId=<?php echo($_GET["sectionId"]); ?>&labId=<?php echo($_GET["labId"]); ?>&labName=<?php echo($_GET["labName"]); ?>" method="post">
      <table>
        <tr>
          <th>ID:</th>
          <th>Section ID:</th>
          <th>Topic:</th>
          <th>Notes:</th>
        </tr>

        <?php
        // Call to the database using the section ID in the skills checklist table and return the information there.  
        // Then use it to build a form where you can add/update items on the skills checklist
        $conn = getConnection();

        $query = "SELECT Skill.Id, Skill.SectionId, Skill.Topic, Notes.Note FROM Skill INNER JOIN Notes ON Skill.Id = Notes.SkillId WHERE Skill.SectionId = ? ORDER BY Skill.Topic";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $_GET["sectionId"], PDO::PARAM_STR);
        $stmt->execute();
        
        $result = $stmt->fetchAll();
        
        if (count($result) == 0) {
                  echo ("<h3 class='error'>NO RESULTS FOUND!</h3>");
        } else {
          foreach($result as $row) {
            $id = $row["Id"];
            $sectionid = $row["SectionId"];
            $topic = $row["Topic"];
            $note = $row["Note"];
            
            echo "<tr>";
            
            echo "<td><input type='text' name='skillID[]' value='$id' readonly /></td>";
            echo "<td><input type='text' name='sectionIDs[]' value='$sectionid' readonly /></td>";
            echo "<td><input type='text' name='topics[]' value='$topic' /></td>";
            echo "<td><input type='text' name='notes[]' value='$note' /></td>";
            
            echo "</tr>";
          }
        }

        $conn = null;
        ?>

        <tr>
          <td colspan="4"><input type="submit" value="Save Changes" name ="update"></td>
        </tr>
      </table>
    </form>
      
    <br>
      
    <h4>Add New Skill:</h4>
    
    <form action="skills.php?sectionId=<?php echo($_GET["sectionId"]); ?>&labId=<?php echo($_GET["labId"]); ?>&labName=<?php echo($_GET["labName"]); ?>" method="post">
      <input type="text" name="topic" placeholder="Topic" required>
      <input type="text" name="notes" placeholder="Notes" required>
      <input type="submit" value="Add Skill" name="add">
    </form>
  </body>
</html>
