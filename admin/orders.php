<?php include "header.php"; ?>
<?php $err = ""; ?>
<?php
if ($user_role != "1") {
  header("location: product.php");
} else {
?>
  <div id="admin-content">
    <div class="container">
      <div class="row">
        <div class="col-md-10">
          <h1 class="admin-heading">All Orders</h1>
        </div>
        <div class="col-md-12">
          <table class="content-table">
            <thead>
              <th>S.No.</th>
              <th>Product</th>
              <th>Product Price</th>
              <th>Product Author</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Total</th>
              <th>Date</th>
              <th>Complete</th>
            </thead>
            <tbody>
              <?php
              if (isset($_REQUEST["current_page"])) {
                $current_page = $_REQUEST["current_page"];
              } else {
                $current_page = 1;
              }
              $offset = ($current_page - 1) * $limit;
              $result_select = allDataPagination($connect, "order_info", $offset, $limit);
              $count = mysqli_num_rows($result_select);
              if ($count > 0) {
                $serial_no = 0;
                while ($row = mysqli_fetch_assoc($result_select)) {
                  $order_id = $row["id"];
                  $order_name = $row["name"];
                  $order_name = ucfirst($order_name);
                  $order_price = $row["price"];
                  $order_quantity = $row["quantity"];
                  $order_author = $row["author"];
                  $order_country = $row["country"];
                  $order_street_address = $row["street_address"];
                  $order_city = $row["city"];
                  $order_postcode = $row["postcode"];
                  $order_address = $order_street_address . ", " . $order_country . ", " . $order_postcode;
                  $order_phone = $row["phone"];
                  $order_email = $row["email"];
                  $order_grand_total = $row["grand_total"];
                  $order_date = $row["date"];
                  $order_name_seperate = explode(",", $order_name);
                  $order_price_seperate = explode(",", $order_price);
                  $order_quantity_seperate = explode(",", $order_quantity);
                  $order_name_count = count($order_name_seperate);
                  $serial_no++;
              ?>
                  <tr>
                    <td class="id"><?php echo $serial_no; ?></td>
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
                    <td><?php echo $order_author; ?></td>
                    <td><?php echo $order_address; ?></td>
                    <td><?php echo $order_phone; ?></td>
                    <td><?php echo $order_email; ?></td>
                    <td>$<?php echo $order_grand_total; ?></td>
                    <td><?php echo $order_date; ?></td>
                    <td><a href='complete_order.php?complete_id=<?php echo $order_id; ?>'><i class='fa fa-check'></i></a></td>
                  </tr>
                <?php
                }
              } else {
                ?>
                <div class="php_error">
                  <?php
                  $err = "there are no customer found on your database.";
                  $err = ucfirst($err);
                  echo $err;
                  ?>
                </div>
              <?php
              }
              ?>
            </tbody>
          </table>

          <?php
          $result_select = allData($connect, "customer_info");
          $total_data = mysqli_num_rows($result_select);
          $total_page = ceil($total_data / $limit);
          if ($total_page > 1) {
          ?>
            <ul class='pagination admin-pagination'>
              <?php
              if ($current_page > 1) {
              ?>
                <li><a href="customers.php?current_page=<?php echo $current_page - 1; ?>">⇽</a></li>
              <?php
              }
              $active_page = "";
              for ($i = 1; $i <= $total_page; $i++) {
                if ($current_page == $i) {
                  $active_page = "active";
                } else {
                  $active_page = "";
                }
              ?>
                <li class="<?php echo $active_page; ?>"><a href="customers.php?current_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
              <?php
              }
              if ($current_page < $total_page) {
              ?>
                <li><a href="customers.php?current_page=<?php echo $current_page + 1; ?>">⇾</a></li>
              <?php
              }
              ?>
            </ul>
          <?php
          }
          ?>
          <?php
          if (isset($_REQUEST["err"])) {
            $getErr = $_REQUEST["err"];
            if ($getErr == "successfullyCompleted") {
              $err = "successfully completed this order.";
            } else {
              $err = "";
            }
            $err = ucfirst($err);
          ?>
            <div class="php_error">
              <?php echo $err; ?>
            </div>
          <?php
          }
          ?>
          <!-- <ul class='pagination admin-pagination'>
                        <li><a href="users.php">⇽</a></li>
                        <li class=""><a href="users.php">1</a></li>
                        <li class=""><a href="users.php">2</a></li>
                        <li><a href="users.php">⇾</a></li>
                    </ul> -->
        </div>
      </div>
    </div>
  </div>
<?php
}
?>
<?php include "footer.php"; ?>