<?php include "include/connect.php"; ?>
<?php include "include/functions.php"; ?>
<?php
if (isset($_REQUEST["submit"])) {
  $email = mysqli_real_escape_string($connect, $_REQUEST["email"]);
  $username = mysqli_real_escape_string($connect, $_REQUEST["username"]);
  $password = mysqli_real_escape_string($connect, hashPassword($_REQUEST["password"]));
  if (emptyRegister($email, $username, $password) == false) {
    header("location: account.php?err=emptyRegister");
    die();
  }
  if (emailExist($connect, $email) == false) {
    header("location: account.php?err=emailExist");
    die();
  }
  if (usernameExist($connect, $username) == false) {
    header("location: account.php?err=usernameExist");
    die();
  }
  $result_select_customer = createAccount($connect, $email, $username, $password);
  if ($result_select_customer == false) {
    header("location: account.php?err=cannotCreate");
    die();
  }
  while ($row_select_customer = mysqli_fetch_assoc($result_select_customer)) {
    $customer_id = $row_select_customer["customer_id"];
    $customer_firstname = $row_select_customer["firstname"];
    $customer_lastname = $row_select_customer["lastname"];
    $customer_username = $row_select_customer["username"];
    $customer_email = $row_select_customer["email"];
    $_SESSION["current_time"] = time();
    $_SESSION["customer_id"] = $customer_id;
    $_SESSION["customer_username"] = $customer_username;
    $_SESSION["customer_fullname"] = ucfirst($customer_firstname) . " " . ucfirst($customer_lastname);
  }
  header("location: dashboard.php");
}
?>