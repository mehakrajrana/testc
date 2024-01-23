<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
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


$sql = "SELECT * FROM tbl_user WHERE id=" . $_GET['id'];


$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $name= $row['name'];
    $email=$row['email'];
    $address=$row['address'];
   
  }
} else {
  echo "<tr><td colspan='4'>0 results</td></tr>";

}
$conn->close();
?>



<?php
// define variables and set to empty values
$nameErr = $emailErr  = $addressErr = "";
$name = $email  = $address = "";
$valid=true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
	$valid=false;
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
      $valid=false;
    }
	
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $valid=false;
  }
  
   else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $valid=false;
    }
	
  }
    
  

  if (empty($_POST["address"])) {
    $address = "";
    $valid=false;
  }
  
   else {
    $address = test_input($_POST["address"]);
  }
   if ($valid){

$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "csd223_mehak";

// Create connection
$conn = new mysqli($servername, $username, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// Assuming you have already defined $name, $address, $email, and $_GET['id']

$sql = "UPDATE `tbl_user` SET `name`='$name', `address`='$address', `email`='$email' WHERE id=" . $_GET['id'];




//VALUES ('".$name."', '".$email."', '".$address."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

  

   }
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
  }
?>

<h2>PHP CONTACT MANAGEMENT SYSTEM</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="edit.php?id=<?php echo $_GET['id']; ?>">
 
  Name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  
  Address: <textarea name="address" rows="5" cols="40"></textarea>
  <br><br>
  
  <input type="submit" name="submit" value="Add">  
</form>


</body>
</html>
