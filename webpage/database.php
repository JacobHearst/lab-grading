<?php
$servername = "144.13.22.59:3306";
$username = "g4AppUser";
$password = "aug4";
$dbname = "G4AgileExperience";

function getConnection() {
    global $servername, $username, $password, $dbname;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::ATTR_PERSISTENT => true));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch(PDOException $e) {
        $message = $e->getMessage();
        echo "{\"Error\": \"$message\"}";
    }
}

function execQuery($query, $params) {
    $conn = getConnection();
    $stmt = $conn->prepare($query);

    if (isset($params)) {
        $stmt->execute($params);
    } else {
        $stmt->execute();
    }

    return $stmt;
}
?>
