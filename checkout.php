<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | NSN Shopping | Best E-commerce Shopping Website</title>
  <!-- favicon icon -->
  <link rel="icon" href="img/cart.png" type="image/x-icon">
  <!--- googe font montseerat ---->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!--- goggole font poppince ------>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- Font Awesome Icon -->
  <link rel="stylesheet" href="./icon/css/all.min.css">
  <!-- linking stylesheet file -->
  <link rel="stylesheet" href="vendor/css/normalize.css">
  <link rel="stylesheet" href="vendor/css/grid.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/checkout.css">
  <!-- linking javascript file -->
  <script src="js/index.js" defer></script>
</head>

<body>

  <!-- header section start -->

  <?php include "header.php"; ?>

  <!-- header section end -->

  <?php
  if (isset($_SESSION["customer_id"])) {
    if ($count_cart_number == false or $count_cart_number == 0) {
      header("location: cart.php");
      die();
    }
    $result_select_customer = customerData($connect, $customer_id);
    while ($row_select_customer = mysqli_fetch_assoc($result_select_customer)) {
      $customer_firstname = $row_select_customer["firstname"];
      $customer_lastname = $row_select_customer["lastname"];
      $customer_username = $row_select_customer["username"];
      $customer_email = $row_select_customer["email"];
    }
  } else {
    header("location: cart.php");
    die();
  }
  ?>

  <!-- checkout section start -->

  <div class="checkoutContainer">
    <div class="row">
      <div class="checkoutHeader">
        <h4>checkout</h4>
      </div>
    </div>
    <div class="row">
      <div class="checkoutCol1 col1 span-3-of-5">
        <div class="formHeader">
          <h5>Billing details</h5>
        </div>
        <div class="formContainer">
          <form action="place_order.php" method="post" autocomplete="off">
            <div class="formGroup">
              <div class="formCol">
                <label for="fname">First name <span>*</span></label>
                <input type="text" name="fname" value="<?php echo $customer_firstname; ?>" required>
              </div>
              <div class="formCol">
                <label for="lname">Last name <span>*</span></label>
                <input type="text" name="lname" value="<?php echo $customer_lastname; ?>" required>
              </div>
            </div>
            <div class="formGroup">
              <label for="country">Country <span>*</span></label>
              <input type="text" name="country" required>
            </div>
            <div class="formGroup">
              <label for="street">Street address <span>*</span></label>
              <input type="text" name="street" required>
            </div>
            <div class="formGroup">
              <label for="city">Town / City <span>*</span></label>
              <input type="text" name="city" required>
            </div>
            <div class="formGroup">
              <label for="postcode">Postcode <span>*</span></label>
              <input type="text" name="postcode" required>
            </div>
            <div class="formGroup">
              <label for="phone">Phone <span>*</span></label>
              <input type="text" name="phone" required>
            </div>
            <div class="formGroup">
              <label for="email">Email address <span>*</span></label>
              <input type="email" name="email" value="<?php echo $customer_email; ?>" required>
            </div>
            <div class="formGroup">
              <h5>Additional information</h5>
            </div>
            <div class="formGroup">
              <label for="note">Order notes (optional)</label>
              <textarea name="note" cols="5" rows="2"></textarea>
            </div>
            <!-- </form> -->
        </div>
      </div>
      <div class="checkoutCol2 col1 span-2-of-5">
        <div class="cartDetails">
          <div class="detailsHeader">
            <h5>Your order</h5>
          </div>
          <div class="detailsTable">
            <table>
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $vat = 0;
                $subtotal = 0;
                $result_select_cart = $result_cart_number;
                while ($row_select_cart = mysqli_fetch_assoc($result_select_cart)) {
                  $cart_product_id = $row_select_cart["product_id"];
                  $cart_product_name = $row_select_cart["name"];
                  $cart_product_price = $row_select_cart["price"];
                  $cart_product_quantity = $row_select_cart["quantity"];
                  $cart_whole_price = $cart_product_price * $cart_product_quantity;
                  $subtotal += $cart_whole_price;
                  $vat += $cart_product_quantity * 10;
                ?>
                  <tr>
                    <td><?php echo $cart_product_name; ?> × <?php echo $cart_product_quantity; ?></td>
                    <td><?php echo $currency . $cart_whole_price; ?>.00</td>
                  </tr>
                <?php
                }
                $grand_total = $subtotal + $vat;
                ?>
              </tbody>
            </table>
            <table>
              <tr>
                <td>Subtotal</td>
                <td><?php echo $currency . $subtotal; ?>.00</td>
              </tr>
              <tr>
                <td>Vat</td>
                <td><?php echo $currency . $vat; ?>.00</td>
              </tr>
              <tr>
                <td>Total</td>
                <td><?php echo $currency . $grand_total; ?>.00</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="cartForm">
          <!-- <form action="place_order.php" method="post" autocomplete="off"> -->
          <div class="formGroup paymentMethodSelect">
            <select name="payment_method" required>
              <option value="null">Select payment method</option>
              <option value="cash">Cash on delivery</option>
            </select>
          </div>
          <div class="formGroup">
            <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
            <input type="hidden" name="vat" value="<?php echo $vat; ?>">
            <input type="hidden" name="grand_total" value="<?php echo $grand_total; ?>">
            <input type="submit" name="submit" class="btn btnBlock" value="Place Order">
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- checkout section end -->

  <!-- footer section start -->

  <?php include "footer.php"; ?>

  <!-- footer section end -->

</body>

</html>