<?php include "header.php"; ?>
<?php
if (isset($_REQUEST["delete_id"])) {
  $delete_id = $_REQUEST["delete_id"];
  $result_select = selectCategoryProduct($connect, $delete_id);
  while ($row = mysqli_fetch_assoc($result_select)) {
    $category_product = $row["product"];
  }
  if ($category_product > 0) {
    header("location: category.php?err=productHave&numberOfProduct=$category_product");
    die();
  } else {
    if (deleteCategory($connect, $delete_id) == false) {
      header("location: category.php?err=cannotDelete");
      die();
    } else {
      header("location: category.php?err=successfullyDeleted");
    }
  }
}
?>