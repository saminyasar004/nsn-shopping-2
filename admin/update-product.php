<?php include "header.php"; ?>
<?php
if (isset($_REQUEST["submit"])) {
  $product_id = mysqli_real_escape_string($connect, $_REQUEST["product_id"]);
  $product_name = mysqli_real_escape_string($connect, $_REQUEST["product_name"]);
  $product_price = mysqli_real_escape_string($connect, $_REQUEST["product_price"]);
  $product_description = mysqli_real_escape_string($connect, $_REQUEST["product_description"]);
  $old_product_category = mysqli_real_escape_string($connect, $_REQUEST["old_product_category"]);
  $new_product_category = mysqli_real_escape_string($connect, $_REQUEST["new_product_category"]);
  $product_new_image = $_FILES["new_image"];
  $product_new_image_name = $product_new_image["name"];
  $product_old_image = mysqli_real_escape_string($connect, $_REQUEST["old_image"]);
  if ($old_product_category != $new_product_category) {
    if (switchCategory($connect, $new_product_category, $old_product_category) == false) {
      header("location: edit-product.php?err=cannotUpdate");
      die();
    }
  }
  if (empty($product_new_image_name)) {
    $new_image_name = $product_old_image;
  } else {
    $loc = "upload/";
    $product_new_image_tmp_name = $product_new_image["tmp_name"];
    $product_new_image_extension = end(explode(".", $product_new_image_name));
    $valid_extension = array("png", "jpg", "jpeg");
    if (in_array($product_new_image_extension, $valid_extension) == false) {
      header("location: edit-product.php?edit_id=$product_id&err=invalidExtension");
      die();
    }
    $new_image_name = $product_name . "." . $product_new_image_extension;
    unlink($loc . $product_old_image);
    move_uploaded_file($product_new_image_tmp_name, $loc . $new_image_name);
  }
  if (updateProduct($connect, $product_id, $product_name, $product_price, $product_description, $new_product_category, $new_image_name) == false) {
    header("location: edit-product.php?edit_id=$product_id&err=cannotUpdate");
    die();
  } else {
    header("location: product.php?err=successfullyUpdated");
  }
}
?>