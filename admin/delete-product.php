<?php include "header.php"; ?>
<?php
if (isset($_REQUEST["delete_id"]) && isset($_REQUEST["category_id"]) && isset($_REQUEST["image"])) {
  $delete_id = $_REQUEST["delete_id"];
  $category_id = $_REQUEST["category_id"];
  $product_image = $_REQUEST["image"];
  $loc = "upload/";
  if (deleteProduct($connect, $delete_id) == false) {
    header("location: product.php?err=cannotDelete");
    die();
  } else {
    if (decreaseCategoryProduct($connect, $category_id) == false) {
      header("location: product.php?err=cannotDelete");
      die();
    } else {
      unlink($loc . $product_image);
      header("location: product.php?err=successfullyDeleted");
    }
  }
}
