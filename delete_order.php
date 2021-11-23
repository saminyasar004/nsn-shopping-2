<?php include "include/connect.php"; ?>
<?php include "include/functions.php"; ?>
<?php
if (isset($_SESSION["customer_username"]) && isset($_REQUEST["delete_id"])) {
  $customer_username = $_SESSION["customer_username"];
  $delete_id = $_REQUEST["delete_id"];
  $result_delete_order = deleteOrder($connect, $delete_id);
  header("location: order.php");
  die();
}
?>