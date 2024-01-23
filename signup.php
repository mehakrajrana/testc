<!DOCTYPE HTML>  
<html>
<head>
<style>
  body {
    background-color: #FFFFE0; /* Yellow background color */
    text-align: center; /* Center-align the content */
  }

  .error {color: #FF0000;}
</style>
</head>
<body>  

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
  } else {
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
  } else {
    $address = test_input($_POST["address"]);
  }
  
  if ($valid) {
    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "class3";

    // Create connection
    $conn = new mysqli($servername, $username, $dbpassword, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `tbl_user`( `name`, `email`, `address`)
            VALUES ('".$name."', '".$email."', '".$address."')";

    if ($conn->query($sql) === TRUE) {
      echo "New record updated successfully";
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

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Address: <textarea name="address" rows="5" cols="40"></textarea>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

</body>
</html>
