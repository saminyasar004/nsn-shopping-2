<?php include "include/connect.php"; ?>
<?php include "include/functions.php"; ?>
<?php
if (isset($_REQUEST["submit"])) {
  $product_id = mysqli_real_escape_string($connect, $_REQUEST["product_id"]);
  $product_name = mysqli_real_escape_string($connect, $_REQUEST["product_name"]);
  $rate = mysqli_real_escape_string($connect, $_REQUEST["rate"]);
  $comment = mysqli_real_escape_string($connect, $_REQUEST["comment"]);
  $name = mysqli_real_escape_string($connect, $_REQUEST["name"]);
  $email = mysqli_real_escape_string($connect, $_REQUEST["email"]);
  if (emptyComment($rate, $comment, $name, $email) == false) {
    header("location: product_details.php?product_id=$product_id&product_name=$product_name");
    die();
  }
  if (addPendingComment($connect, $product_id, $rate, $comment, $name, $email) == false) {
    header("location: product_details.php?product_id=$product_id&product_name=$product_name");
    die();
  }
  header("location: product_details.php?product_id=$product_id&product_name=$product_name&err=commented");
}
?>