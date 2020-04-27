<html>
    <head>
        <title>Lab Search</title>
        <link rel="stylesheet" type="text/css" href="/Search/style_search.css">
    </head>
    
    <body>
        <h1>Lab Grading Tool</h1>
        <h2>Programmed by: Agile Experience Group 4</h2>
        <h4><a href="../">Return to main page.</a></h4>
        
        <br>
        <hr>
        
        <h2>Search For Lab:</h2>
        
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

        function echoChecked($searchType) {
            global $searchTypes;
            $isSelected = false;

            if (isset($searchTypes)) {
                $isSelected = in_array($searchType, $searchTypes);
            }

            echo $isSelected ? "checked" : "";
        }
        ?>
        
        <form action="" method="post">
            <div id="search-types-container">
                <label for="search-types">Search by:</label>
                <ul id="search-types">
                    <li><input type="checkbox" <?php echoChecked("LabName");?> name="searchTypes[]" value="LabName">Lab Name</input></li>
                    <li><input type="checkbox" <?php echoChecked("StudentName");?> name="searchTypes[]" value="StudentName">Student Name</input></li>
                    <li><input type="checkbox" <?php echoChecked("Professor");?> name="searchTypes[]" value="Professor">Professor</input></li>
                    <li><input type="checkbox" <?php echoChecked("Course");?> name="searchTypes[]" value="Course">Course</input></li>
                </ul>
            </div>

            <input type="text" name="search" value="<?php echo $searchTerm; ?>">

            <input type="submit" value="Submit">
        </form>
            
        <br>
        <hr>
        
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
            $result = execQuery($query, $params);
        }

        if (isset($result)) {
            echo "<table>
            <tr>
                <th>ID:</th>
                <th>Name:</th>
                <th>Description:</th>
                <th>Due Date:</th>
                <th>Score:</th>
                <th>Section ID:</th>
				<th>Skills Checklist:</th>
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
                    
                    echo "<td>$id</td>";
                    echo "<td><a href='../GradeLab/grade_single_value.php'>$name</a></td>";
                    //echo "<td><a href='../GradeLab/grade_single_value.php?sectionId=$sectionID'>$name</a></td>";
                    echo "<td>$description</td>";
                    echo "<td>$dueDate</td>";
                    echo "<td>$score</td>";
                    echo "<td>$sectionID</td>";
                    echo "<td><a href='../SkillsChecklist/skills.php?sectionId=$sectionID'>View</a></td>";
                    
                    echo "</tr>";
                }
            }
            echo "</table>";
        }
        ?>
    
    </body>
</html>

