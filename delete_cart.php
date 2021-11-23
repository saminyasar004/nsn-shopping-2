<?php include "include/connect.php"; ?>
<?php include "include/functions.php"; ?>
<?php
if (isset($_REQUEST["delete_id"])) {
  $delete_id = $_REQUEST["delete_id"];
  deleteCart($connect, $delete_id);
  header("location: cart.php");
}
?>