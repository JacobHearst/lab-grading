<?php
$servername = "144.13.22.59:3306";
$username = "g4AppUser";
$password = "aug4";
$dbname = "G4AgileExperience";

/**
 * Get a database connection to execute queries with
 */
function getConnection() {
  global $servername, $username, $password, $dbname;
  try {
    $conn = new PDO(
        "mysql:host=$servername;dbname=$dbname",
        $username,
        $password,
        array(PDO::ATTR_PERSISTENT => true)
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  }
  catch(PDOException $e) {
    $message = $e->getMessage();
    echo "{\"Error\": \"$message\"}";
  }
}

/**
 * Execute a SQL query on the database using a prepared statement.
 * Assumes that any parameters in the statement are replaced with
 * question marks
 * 
 * @param {string} $query The SQL query
 * @param {array} $params The parameters for the SQL statement
 */
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
