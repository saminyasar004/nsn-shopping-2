<?php include "header.php"; ?>

<?php
if (isset($_REQUEST["complete_id"])) {
  $complete_id = $_REQUEST["complete_id"];
  $result_complete = completeOrder($connect, $complete_id);
  header("location: orders.php?err=successfullyCompleted");
  die();
}
?>