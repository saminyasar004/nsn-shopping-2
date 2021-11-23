<?php include "include/connect.php"; ?>
<?php include "include/functions.php"; ?>
<?php
if (isset($_SESSION["customer_id"])) {
  if (isset($_REQUEST["submit"]) && isset($_REQUEST["product_id"])) {
    $product_id = mysqli_real_escape_string($connect, $_REQUEST["product_id"]);
    $product_quantity = mysqli_real_escape_string($connect, $_REQUEST["quantity"]);
    if ($product_quantity < 1) {
      $product_quantity = 1;
    } else if ($product_quantity > 100) {
      $product_quantity = 100;
    }
    if (productById($connect, $product_id) == false) {
      header("location: store.php");
      die();
    } else {
      $result_product_data = productById($connect, $product_id);
      $count = mysqli_num_rows($result_product_data);
      if ($count == 0) {
        header("location: store.php");
        die();
      } else {
        while ($row_product_data = mysqli_fetch_assoc($result_product_data)) {
          $product_img = $row_product_data["img"];
          $product_name = $row_product_data["name"];
          $product_description = $row_product_data["description"];
          $product_price = $row_product_data["price"];
        }
        $author = $_SESSION["customer_username"];
        $cart_time = date($time_format, time());
        if (selectCartById($connect, $product_id) != false) {
          $result_select_cart = selectCartById($connect, $product_id);
          while ($row_select_cart = mysqli_fetch_assoc($result_select_cart)) {
            $cart_id = $row_select_cart["id"];
            if (updateCart($connect, $cart_id, $product_quantity) == false) {
              header("location: store.php");
            } else {
              header("location: cart.php");
            }
          }
        } else {
          if (insertCart($connect, $product_id, $product_img, $product_name, $product_description, $product_price, $product_quantity, $author, $cart_time) == false) {
            header("location: store.php");
            die();
          } else {
            header("location: cart.php");
          }
        }
      }
    }
  } else {
    header("location: store.php");
    die();
  }
} else {
  header("location: account.php");
  die();
}
?>