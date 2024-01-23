<?php

echo $_GET['id'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csd223_mehak";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM tbl_user WHERE id=".$_GET['id'];
$result = $conn->query($sql);

header('Location:view.php');

$conn->close();
?>
