<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My account | NSN Shopping | Best E-commerce Shopping Website</title>
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
  <link rel="stylesheet" href="css/account_menu.css">
  <link rel="stylesheet" href="css/account_details.css">
  <!-- linking javascript file -->
  <script src="js/index.js" defer></script>
</head>

<body>

  <!-- header section start -->

  <?php include "header.php"; ?>

  <!-- header section end -->

  <?php
  $customer_id = $_SESSION["customer_id"];
  $result_select_customer = customerData($connect, $customer_id);
  while ($row_select_customer = mysqli_fetch_assoc($result_select_customer)) {
    $customer_username = $row_select_customer["username"];
    $customer_firstname = $row_select_customer["firstname"];
    $customer_lastname = $row_select_customer["lastname"];
    $customer_email = $row_select_customer["email"];
    $customer_password = $row_select_customer["password"];
  }
  ?>

  <!-- account details section start -->

  <div class="row">
    <div class="accountDetailsContainer">
      <?php include "account_menu.php"; ?>
      <div class="accountDetailsItems col1 span-4-of-6">
        <form action="update_account.php" method="post" autocomplete="off">
          <?php
          if (isset($_REQUEST["err"])) {
            $getErr = $_REQUEST["err"];
            if ($getErr == "emptyField") {
              $err = "password fileds are required if you want to change your password.";
            } else if ($getErr == "cannotUpdate") {
              $err = "something went wrong to update your account.";
            } else if ($getErr == "passwordNotMatch") {
              $err = "your current password does not match.";
            } else if ($getErr == "successfullyUpdated") {
              $err = "successfully updated your account information.";
            } else if ($getErr == "usernameExist") {
              $err = "this username is already taken.";
            } else if ($getErr == "emailExist") {
              $err = "this email is already taken.";
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
          <div class="formGroup">
            <div class="formCol">
              <label for="fname">first name <span>*</span></label>
              <input type="text" name="fname" value="<?php echo $customer_firstname; ?>">
            </div>
            <div class=" formCol">
              <label for="lname">last name <span>*</span></label>
              <input type="text" name="lname" value="<?php echo $customer_lastname; ?>">
            </div>
          </div>
          <div class="formGroup">
            <label for="username">username <span>*</span></label>
            <input type="username" name="username" value="<?php echo $customer_username; ?>" readonly>
          </div>
          <div class="formGroup">
            <label for="email">email address <span>*</span></label>
            <input type="email" name="email" value="<?php echo $customer_email; ?>" readonly>
          </div>
          <div class="formGroup">
            <label for="current_password">current password (leave blank to leave unchanged)</label>
            <input type="hidden" name="customer_password" value="<?php echo $customer_password; ?>">
            <input type="password" name="current_password">
          </div>
          <div class="formGroup">
            <label for="new_password">new password (leave blank to leave unchanged)</label>
            <input type="password" name="new_password">
          </div>
          <div class="formGroup">
            <input class="btn" type="submit" name="submit" value="Save Changes">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- account details section end -->

  <!-- footer section start -->

  <?php include "footer.php"; ?>

  <!-- footer section end -->

</body>

</html>