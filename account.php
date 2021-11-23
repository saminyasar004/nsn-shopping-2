<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account | NSN Shopping | Best E-commerce Shopping Website</title>
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
  <link rel="stylesheet" href="css/account.css">
  <!-- linking javascript file -->
  <script src="js/index.js" defer></script>
</head>

<body>

  <!-- header section start -->

  <?php include "header.php"; ?>

  <!-- header section end -->

  <?php
  if (isset($_SESSION["customer_username"])) {
    header("location: dashboard.php");
  }
  ?>

  <!-- account section start -->

  <div class="accountContainer">
    <div class="row">
      <div class="accountHeader">
        <h2>my account</h2>
      </div>
    </div>
    <div class="row formContainer">
      <div class="loginSection">
        <div class="loginHeader">
          <h3>login</h3>
        </div>
        <div class="loginForm">
          <?php
          if (isset($_REQUEST["err"])) {
            $getErr = $_REQUEST["err"];
            if ($getErr == "emptyLogin") {
              $err = "all fields are required";
            } else if ($getErr == "invalidLogin") {
              $err = "incorrect login details";
            } else {
              $err = "";
            }
            $err = ucfirst($err);
          ?>
            <div class="php_error">
              <?php echo $err; ?>
            </div>
          <?php
          }
          ?>
          <form action="login.php" method="post" autocomplete="off">
            <div class="formGroup">
              <label for="username">username <span>*</span></label>
              <input type="text" name="username" id="username">
            </div>
            <div class="formGroup">
              <label for="password">password <span>*</span></label>
              <input type="password" name="password" id="password">
            </div>
            <div class="formGroup resetPassword">
              <a href="reset_password.php">lost your password?</a>
            </div>
            <div class="formGroup">
              <input class="btn" type="submit" name="submit" value="login">
            </div>
          </form>
        </div>
      </div>
      <div class="regSection">
        <div class="regHeader">
          <h3>register</h3>
        </div>
        <div class="regForm">
          <?php
          if (isset($_REQUEST["err"])) {
            $getErr = $_REQUEST["err"];
            if ($getErr == "emptyRegister") {
              $err = "all fields are required.";
            } else if ($getErr == "emailExist") {
              $err = "this email is already taken. please use another email address.";
            } else if ($getErr == "usernameExist") {
              $err = "this username is already taken. please use another username.";
            } else if ($getErr == "cannotCreate") {
              $err = "something went wrong to create your account. please try again later.";
            } else {
              $err = "";
            }
            $err = ucfirst($err);
          ?>
            <div class="php_error">
              <?php echo $err; ?>
            </div>
          <?php
          }
          ?>
          <form action="register.php" method="post" autocomplete="off">
            <div class="formGroup">
              <label for="email">email <span>*</span></label>
              <input type="text" name="email" id="email">
            </div>
            <div class="formGroup">
              <label for="usernameRegister">username <span>*</span></label>
              <input type="text" name="username" id="usernameRegister">
            </div>
            <div class="formGroup">
              <label for="passwordRegister">password <span>*</span></label>
              <input type="password" name="password" id="passwordRegister">
            </div>
            <div class="formGroup">
              <input class="btn" type="submit" name="submit" value="register">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- account section end -->

  <!-- footer section start -->

  <?php include "footer.php"; ?>

  <!-- footer section end -->

</body>

</html>