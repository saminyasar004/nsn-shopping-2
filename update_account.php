<?php include "include/connect.php"; ?>
<?php include "include/functions.php"; ?>

<?php
if (isset($_REQUEST["submit"])) {
  $update_id = $_SESSION["customer_id"];
  $update_fname = mysqli_real_escape_string($connect, $_REQUEST["fname"]);
  $update_lname = mysqli_real_escape_string($connect, $_REQUEST["lname"]);
  $customer_password = mysqli_real_escape_string($connect, $_REQUEST["customer_password"]);
  $update_current_password = mysqli_real_escape_string($connect, hashPassword($_REQUEST["current_password"]));
  $update_new_password = mysqli_real_escape_string($connect, hashPassword($_REQUEST["new_password"]));
  if (empty($update_current_password) && empty($update_new_password)) {
    if (updateAccount($connect, $update_id, $update_fname, $update_lname) == false) {
      header("location: account_details.php?err=cannotUpdate");
      die();
    } else {
      updateAccount($connect, $update_id, $update_fname, $update_lname);
      header("location: account_details.php?err=successfullyUpdated");
    }
  } else if (!empty($update_current_password) && !empty($update_new_password)) {
    if ($customer_password == $update_current_password) {
      if (updateAccountWithPassword($connect, $update_id, $update_fname, $update_lname, $update_new_password) == false) {
        header("location: account_details.php?err=cannotUpdate");
        die();
      } else {
        updateAccountWithPassword($connect, $update_id, $update_fname, $update_lname, $update_new_password);
        header("location: account_details.php?err=successfullyUpdated");
      }
    } else {
      header("location: account_details.php?err=passwordNotMatch");
      die();
    }
  } else {
    header("location: account_details.php");
  }
}
?>