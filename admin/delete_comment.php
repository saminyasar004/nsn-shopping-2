<?php include "header.php"; ?>
<?php
if (isset($_REQUEST["comment_id"])) {
  $comment_id = $_REQUEST["comment_id"];
  if (deleteComment($connect, $comment_id) == false) {
    header("location: pending_comment.php?err=cannotDelete");
    die();
  }
  header("location: pending_comment.php?err=successfullyDeleted");
}
?>