<?php
function getDbConnection() {
  $server = "128.199.208.34";
  $username = "opennote";
  $password = "12345678901";
  $dbname = "opennote";

  // Create connection

  $conn = new mysqli($server, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
    exit;
  } else {
    //echo "Success: connected to MySQL";
  }

  return $conn;
  // $con->close();
}
?>
