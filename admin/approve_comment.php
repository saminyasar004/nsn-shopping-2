<?php include "header.php"; ?>
<?php
if (isset($_REQUEST["comment_id"])) {
  $comment_id = $_REQUEST["comment_id"];
  $result_all_comment = allPendingCommentById($connect, $comment_id);
  if ($result_all_comment == false) {
    header("location: pending_comment.php?err=cannotFindData");
    die();
  } else {
    while ($row_all_comment = mysqli_fetch_assoc($result_all_comment)) {
      $id = $row_all_comment["id"];
      $product_id = $row_all_comment["product_id"];
      $rate = $row_all_comment["rate"];
      $comment = $row_all_comment["comment"];
      $name = $row_all_comment["name"];
      $email = $row_all_comment["email"];
    }
    $result_approve_comment = approveComment($connect, $product_id, $rate, $comment, $name, $email);
    if ($result_approve_comment == false) {
      header("location: pending_comment.php?err=cannotApprove");
    } else {
      $result_remove_pending_comment = removePendingComment($connect, $comment_id);
      if ($result_remove_pending_comment == false) {
        header("location: pending_comment.php?err=cannotApprove");
      } else {
        header("location: pending_comment.php?err=successfullyApproved");
      }
    }
  }
}
?>