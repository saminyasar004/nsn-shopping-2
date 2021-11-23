<?php include "header.php"; ?>
<?php
if ($user_role != "1") {
  header("location: product.php");
} else {
  if (isset($_REQUEST["delete_id"])) {
    $delete_id = $_REQUEST["delete_id"];
    if (deleteUser($connect, $delete_id) == false) {
      header("location: users.php?err=cannotDelete");
      die();
    } else {
      header("location: users.php");
    }
  }
}
?>