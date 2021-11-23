<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order | NSN Shopping | Best E-commerce Shopping Website</title>
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
  <link rel="stylesheet" href="css/account_menu.css">
  <link rel="stylesheet" href="css/order.css">
  <!-- linking javascript file -->
  <script src="js/index.js" defer></script>
</head>

<body>

  <!-- header section start -->

  <?php include "header.php"; ?>

  <!-- header section end -->

  <!-- order section start -->

  <div class="row">
    <div class="orderContainer">
      <?php include "account_menu.php"; ?>
      <div class="orderItems col1 span-4-of-6">
        <?php
        $customer_username = $_SESSION["customer_username"];
        $serial_no = 0;
        $result_select_order = selectOrderByAuthor($connect, $customer_username);
        $count_select_order = mysqli_num_rows($result_select_order);
        if ($count_select_order > 0) {
        ?>
          <table>
            <thead>
              <tr>
                <th>order</th>
                <th>product details</th>
                <th>price</th>
                <th>date</th>
                <th>total</th>
                <th>action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row_select_order = mysqli_fetch_assoc($result_select_order)) {
                $order_id = $row_select_order["id"];
                $order_name = $row_select_order["name"];
                $order_quantity = $row_select_order["quantity"];
                $order_price = $row_select_order["price"];
                $order_date = $row_select_order["date"];
                $order_grand_total = $row_select_order["grand_total"];
                $order_name_seperate = explode(",", $order_name);
                $order_quantity_seperate = explode(",", $order_quantity);
                $order_price_seperate = explode(",", $order_price);
                $order_name_count = count($order_name_seperate);
                $serial_no++;
              ?>
                <tr>
                  <td>#<?php echo $serial_no; ?></td>
                  <td><?php
                      for ($i = 0; $i < $order_name_count; $i++) {
                        echo $order_name_seperate[$i] . " × " . $order_quantity_seperate[$i] . "<br>";
                      }
                      ?></td>
                  <td><?php
                      for ($i = 0; $i < $order_name_count; $i++) {
                        echo $order_price_seperate[$i] . "<br>";
                      }
                      ?></td>
                  <td><?php echo $order_date; ?></td>
                  <td><?php echo $currency . $order_grand_total; ?>.00</td>
                  <td><a onclick="return confirm('Are you sure to delete this product from your order?')" href='delete_order.php?delete_id=<?php echo $order_id; ?>'>
                      <i class='far fa-trash-alt'></i>
                    </a></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        <?php
        } else {
        ?>
          <div class="php_error">
            <?php echo "You have no order to show."; ?>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <!-- order section end -->

  <!-- footer section start -->

  <?php include "footer.php"; ?>

  <!-- footer section end -->

</body>

</html>