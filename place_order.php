<?php include "include/connect.php"; ?>
<?php include "include/functions.php"; ?>

<?php
if (isset($_REQUEST["submit"])) {
  $customer_username = $_SESSION["customer_username"];
  $cart_total_product_id = [];
  $cart_total_product_name = [];
  $cart_total_product_price = [];
  $cart_total_product_quantity = [];
  $cart_total_product_date = [];
  $result_select_cart = selectCartByAuthor($connect, $customer_username);
  while ($row_select_cart = mysqli_fetch_assoc($result_select_cart)) {
    $cart_product_id = $row_select_cart["product_id"];
    $cart_product_name = $row_select_cart["name"];
    $cart_product_price = $row_select_cart["price"];
    $cart_product_quantity = $row_select_cart["quantity"];
    $cart_date = $row_select_cart["date"];
    array_push($cart_total_product_id, $cart_product_id);
    array_push($cart_total_product_name, $cart_product_name);
    array_push($cart_total_product_price, $currency . $cart_product_price);
    array_push($cart_total_product_quantity, $cart_product_quantity);
    array_push($cart_total_product_date, $cart_date);
  }
  $checkout_fname = mysqli_real_escape_string($connect, $_REQUEST["fname"]);
  $checkout_lname = mysqli_real_escape_string($connect, $_REQUEST["lname"]);
  $checkout_country = mysqli_real_escape_string($connect, $_REQUEST["country"]);
  $checkout_street = mysqli_real_escape_string($connect, $_REQUEST["street"]);
  $checkout_city = mysqli_real_escape_string($connect, $_REQUEST["city"]);
  $checkout_postcode = mysqli_real_escape_string($connect, $_REQUEST["postcode"]);
  $checkout_phone = mysqli_real_escape_string($connect, $_REQUEST["phone"]);
  $checkout_email = mysqli_real_escape_string($connect, $_REQUEST["email"]);
  $checkout_payment_method = mysqli_real_escape_string($connect, $_REQUEST["payment_method"]);
  $checkout_subtotal = mysqli_real_escape_string($connect, $_REQUEST["subtotal"]);
  $checkout_vat = mysqli_real_escape_string($connect, $_REQUEST["vat"]);
  $checkout_grand_total = mysqli_real_escape_string($connect, $_REQUEST["grand_total"]);
  if ($checkout_payment_method == "null") {
    $checkout_payment_method = "cash";
  }
  $result_clear_cart = clearCart($connect, $customer_username);
  if ($result_clear_cart == false) {
    header("location: checkout.php");
    die();
  }

  $cart_total_product_id_comma_seperated = implode(",", $cart_total_product_id);
  $cart_total_product_name_comma_seperated = implode(",", $cart_total_product_name);
  $cart_total_product_price_comma_seperated = implode(",", $cart_total_product_price);
  $cart_total_product_quantity_comma_seperated = implode(",", $cart_total_product_quantity);
  $cart_total_product_date_comma_seperated = implode(",", $cart_total_product_date);

  $result_cart_to_order = insertOrder($connect, $cart_total_product_id_comma_seperated, $cart_total_product_name_comma_seperated, $cart_total_product_price_comma_seperated, $cart_total_product_quantity_comma_seperated, $customer_username, $checkout_fname, $checkout_lname, $checkout_country, $checkout_street, $checkout_city, $checkout_postcode, $checkout_phone, $checkout_email, $checkout_payment_method, $checkout_subtotal, $checkout_vat, $checkout_grand_total, $cart_total_product_date_comma_seperated);

  if ($result_cart_to_order == false) {
    header("location: checkout.php");
    die();
  } else {
    header("location: order.php");
  }
}
?>