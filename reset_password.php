<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Recovery | NSN Shopping | Best E-commerce Shopping Website</title>
  <!-- favicon icon -->
  <link rel="icon" href="img/cart.png" type="image/x-icon">
  <!--- googe font montseerat ---->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!--- goggole font poppince ------>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- Font Awesome Icon -->
  <link rel="stylesheet" href="./icon/css/all.min.css">
  <!-- linking stylesheet file -->
  <link rel="stylesheet" href="vendor/css/normalize.css">
  <link rel="stylesheet" href="vendor/css/grid.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/reset_password.css">
  <!-- linking javascript file -->
  <script src="js/index.js" defer></script>
</head>

<body>

  <!-- header section start -->

  <?php include "header.php"; ?>

  <!-- header section end -->

  <!-- reset password section start -->

  <?php
  $username = "";
  if (isset($_REQUEST["submit"])) {
    $username = mysqli_real_escape_string($connect, $_REQUEST["username"]);
    if ($username == "") {
      $username = "";
    }
    $result_select_password = seePassword($connect, $username);
    while ($row_select_password = mysqli_fetch_assoc($result_select_password)) {
      $password = unhashPassword($row_select_password["password"]);
    }
  ?>
    <div class="php_error">
      <?php echo "Your password is: " . $password; ?>
    </div>
  <?php
  }
  ?>

  <div class="resetPassword">
    <div class="row">
      <div class="resetHeader">
        <h3>my account</h3>
        <p>lost your password? please enter your username or email address. you will receive a link to create a new password via email.</p>
      </div>
    </div>
    <div class="row">
      <div class="resetForm">
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" autocomplete="off">
          <div class="formGroup">
            <label for="username">username <span>*</span></label>
            <input type="text" name="username" value="<?php echo $username; ?>" required>
          </div>
          <div class="formGroup">
            <input class="btn" type="submit" name="submit" value="Reset Password">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- reset password section end -->

  <!-- footer section start -->

  <?php include "footer.php"; ?>

  <!-- footer section end -->

</body>

</html>