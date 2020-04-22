<?php
$servername = "144.13.22.59:3306";
$username = "g4AppUser";
$password = "aug4";
$dbname = "G4AgileExperience";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT Id, Name, Description, DueDate, Score, SectionId FROM Diver");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
