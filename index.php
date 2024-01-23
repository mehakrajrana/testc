
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- ... Your existing head content ... -->
</head>

<body>

  <div class="hero-area text-center">
    <h1 class="red">WELCOME TO BANKING SOFTWARE</h1>
    <?php include('nav.php'); ?>
    <div style="padding-left: 16px">
      <h2>WELCOME</h2>
      <p></p>
    </div>

    <?php
    for ($i = 0; $i <= 10; $i++) {
      echo "<p>mehak</p>";
    }
    ?>

    <!-- User Details and Logout Buttons -->
    <!-- User Details and Logout Buttons -->
<div>
  <a href="amount.php" class="btn btn-primary">User Details</a>
  <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

  </div>

  <div class="footer text-center">
    <p>developed by mehak</p>
  </div>

  <!-- Bootstrap JS and Popper.js -->
  <!-- ... Your existing script includes ... -->

</body>

</html>
