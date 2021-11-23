<?php $err = ""; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart | NSN Shopping | Best E-commerce Shopping Website</title>
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
  <link rel="stylesheet" href="css/cart.css">
  <!-- linking javascript file -->
  <script src="js/index.js" defer></script>
</head>

<body>

  <!-- header section start -->

  <?php include "header.php"; ?>

  <!-- header section end -->

  <!-- cart container section start -->

  <div class="cartContainer">
    <?php
    if (isset($_SESSION["customer_id"])) {
      $customer_username = $_SESSION["customer_username"];
      $customer_id = $_SESSION["customer_id"];
      if (selectCartByAuthor($connect, $customer_username) == false) {
        header("location: store.php");
        die();
      } else {
        $result_cart_select = selectCartByAuthor($connect, $customer_username);
        $count_cart_select = mysqli_num_rows($result_cart_select);
        if ($count_cart_select > 0) {
          $subtotal = 0;
          $vat = 0;
    ?>
          <div class="row">
            <div class="cartTableContainer">
              <table class="cartTable">
                <thead>
                  <tr>
                    <th>image</th>
                    <th>name</th>
                    <th>quantity</th>
                    <th>date</th>
                    <th>price</th>
                    <th>delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($row_cart_select = mysqli_fetch_assoc($result_cart_select)) {
                    $cart_id = $row_cart_select["id"];
                    $cart_product_id = $row_cart_select["product_id"];
                    $cart_img = $row_cart_select["img"];
                    $cart_name = $row_cart_select["name"];
                    $cart_description = $row_cart_select["description"];
                    $cart_price = $row_cart_select["price"];
                    $cart_quantity = $row_cart_select["quantity"];
                    $cart_whole_price = $cart_price * $cart_quantity;
                    $cart_author = $row_cart_select["author"];
                    $cart_date = $row_cart_select["date"];
                    $subtotal += $cart_whole_price;
                    $vat += $cart_quantity * 10;
                  ?>
                    <tr>
                      <td><img src="admin/upload/<?php echo $cart_img; ?>" id="cartTableProductImage"></td>
                      <td><?php echo $cart_name; ?></td>
                      <td><?php echo $cart_quantity; ?></td>
                      <td><?php echo $cart_date; ?></td>
                      <td><?php echo $currency . $cart_whole_price; ?>.00</td>
                      <td>
                        <a onclick="return confirm('Are you sure to delete this product from your cart?')" href='delete_cart.php?delete_id=<?php echo $cart_id; ?>'>
                          <i class='far fa-trash-alt'></i>
                        </a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="cartTotalContainer">
              <table>
                <tr>
                  <td>subtotal</td>
                  <td><?php echo $currency . $subtotal; ?>.00</td>
                </tr>
                <tr>
                  <td>vat</td>
                  <td><?php echo $currency . $vat; ?>.00</td>
                </tr>
                <tr>
                  <td>total</td>
                  <td><?php echo $currency . $grand_total = $subtotal + $vat; ?>.00</td>
                </tr>
              </table>
              <div class="checkoutContainer">
                <a href="checkout.php" class="btn btnBlock">Proceed to checkout</a>
              </div>
            </div>
          </div>
          <!-- <div class="row">
          <div class="checkoutContainer">
            <a href="checkout.php" class="btn btnBlock">checkout</a>
          </div>
        </div> -->
    <?php
        } else {
          $err = "you have no product on your cart.";
        }
      }
    } else {
      header("location: account.php");
      die();
    }
    ?>
  </div>

  <!-- cart container section end -->

  <!-- error section start -->

  <?php
  if ($err != "") {
    $err = ucfirst($err);
  ?>
    <div class="php_error">
      <?php echo $err; ?>
    </div>
  <?php
  }
  ?>

  <!-- error section end -->

  <!-- footer section start -->

  <?php include "footer.php"; ?>

  <!-- footer section end -->

</body>

</html>