<html>

<head>
  <title>Lab Search</title>
  <link rel="stylesheet" type="text/css" href="/Search/style_search.css">
</head>

<body>

  <div id="header-wrapper">
    <div id="header" class="container">
      <div id="logo">
        <h1><a>Lab Grading Tool</a></h1>
      </div>
      <div id="menu">
        <ul>
          <li><a href="../index.html" title="">Homepage</a></li>
          <li><a href="#" title="">Lab Search</a></li>
        </ul>
      </div>
    </div>
  </div>






  <?php
  $searchTerm = null;
  $searchTypes = null;

  if (isset($_POST["search"])) {
    $searchTerm = $_POST["search"];
  }

  if (isset($_POST["searchTypes"])) {
    $searchTypes = $_POST["searchTypes"];
  } else {
    // Set a default selected option
    $searchTypes = array("LabName");
  }

  function echoChecked($searchType)
  {
    global $searchTypes;
    $isSelected = false;

    if (isset($searchTypes)) {
      $isSelected = in_array($searchType, $searchTypes);
    }

    echo $isSelected ? "checked" : "";
  }
  ?>

  <div class="wrapper">
    <br>
    <div class="container">
      <form action="" method="post">
        <div id="search-types-container" class="container">
          <ul id="search-types">
            <li>Search By: </li>
            <li><input type="checkbox" <?php echoChecked("LabName"); ?> name="searchTypes[]" value="LabName">Lab Name</input></li>
            <li><input type="checkbox" <?php echoChecked("StudentName"); ?> name="searchTypes[]" value="StudentName">Student Name</input></li>
            <li><input type="checkbox" <?php echoChecked("Professor"); ?> name="searchTypes[]" value="Professor">Professor</input></li>
            <li><input type="checkbox" <?php echoChecked("Course"); ?> name="searchTypes[]" value="Course">Course</input></li>
          </ul>
        </div>

        <div class="wrap">
          <div class="search">
            <input type="text" class="searchTerm" name="search" placeholder="Search..." value="<?php echo $searchTerm; ?>">
            <input type="submit" class="searchButton" value="Submit">
      </form>
    </div>
  </div>

  <br>
  <?php
  if (isset($searchTypes) && isset($searchTerm)) {
    include "../database.php";

    $query = "SELECT L.* FROM Lab L WHERE ";
    $params = array();

    $isFirst = true;
    foreach ($searchTypes as $index => $searchType) {
      // Add OR if there are multiple search types
      if ($isFirst) {
        $isFirst = false;
      } else {
        $query .= " OR ";
      }

      switch ($searchType) {
        case "LabName":
          $query .= "Name LIKE ?";
          array_push($params, "$searchTerm%");
          break;
        case "StudentName":
          $query .= "EXISTS (SELECT 1 FROM UserSection US WHERE
                            (EXISTS (SELECT 1 FROM User U WHERE
                                (U.FirstName LIKE ? OR U.LastName LIKE ?)
                                AND (US.userId = U.id)
                            ))
                            AND (L.sectionId = US.sectionId)
                        )";
          array_push($params, "$searchTerm%", "$searchTerm%");
          break;
        case "Professor":
          $query .= "EXISTS (SELECT 1 FROM Section S WHERE
                            (EXISTS (SELECT 1 FROM Course C WHERE
                                (EXISTS (SELECT 1 FROM User U WHERE
                                    (
                                        (U.FirstName LIKE ? OR U.LastName LIKE ?) 
                                        AND U.IsProfessor = True
                                    )
                                    AND (C.UserId = U.Id)
                                )) 
                                AND (S.courseId = C.Id)
                            )) 
                            AND (L.sectionId = S.Id)
                        )";
          array_push($params, "$searchTerm%", "$searchTerm%");
          break;
        case "Course":
          $query .= "EXISTS (SELECT 1 FROM Section S WHERE
                            (EXISTS (SELECT 1  FROM Course C WHERE
                                (C.Name LIKE ?) 
                                AND (S.courseId = C.Id)
                            ))
                            AND (L.sectionId = S.Id)
                        )";
          array_push($params, "$searchTerm%");
          break;
        default:
          break;
      }
    }
  }

  if (isset($query) && isset($params)) {
    $result = execQuery($query, $params)->fetchAll(PDO::FETCH_ASSOC);
  }

  if (isset($result)) {
    echo "<table>
            <tr>
                <th>Name:</th>
                <th>Grading Link:</th>
                <th>Description:</th>
                <th>Due Date:</th>
                <th>Score:</th>
                <th>Section ID:</th>
                <th>Skills Checklist:</th>
                <th>Notes:</th>
            </tr>";

    //Check if the results returned 0 rows
    if (count($result) == 0) {
      echo ("<h3>NO RESULTS FOUND!</h3>");
    } else {
      foreach ($result as $i => $row) {
        // This will loop through each row
        $id = $row["Id"];
        $name = $row["Name"];
        $description = $row["Description"];
        $dueDate = $row["DueDate"];
        $score = $row["Score"];
        $sectionID = $row["SectionId"];

        echo "<tr>";

        echo "<td><a href='../Lab/lab.php?lab_id=$id&lab_name=$name&section_id=$sectionID'>$name</a></td>";
        echo "<td><a href='../GradeLab/grade_single_value.php?lab_id=$id&lab_name=$name&section_id=$sectionID'>$name</a></td>";
        echo "<td>$description</td>";
        echo "<td>$dueDate</td>";
        echo "<td>$score</td>";
        echo "<td>$sectionID</td>";
        echo "<td><a href='../SkillsChecklist/skills.php?sectionId=$sectionID'>View</a></td>";
        echo "<td><a href='../LabNotes?labId=$id'>View</a></td>";

        echo "</tr>";
      }
    }
    echo "</table>";
  }
  ?>
  </div>
  </div>

  <div id="footer">
    <div class="container">
    </div>
  </div>
</body>

</html>