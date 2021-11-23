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
          <h1 class="admin-heading">All Customers</h1>
        </div>
        <div class="col-md-12">
          <table class="content-table">
            <thead>
              <th>S.No.</th>
              <th>Customer Id</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>User Name</th>
              <th>Email</th>
            </thead>
            <tbody>
              <?php
              if (isset($_REQUEST["current_page"])) {
                $current_page = $_REQUEST["current_page"];
              } else {
                $current_page = 1;
              }
              $offset = ($current_page - 1) * $limit;
              $result_select = allDataPagination($connect, "customer_info", $offset, $limit);
              $count = mysqli_num_rows($result_select);
              if ($count > 0) {
                $serial_no = 0;
                while ($row = mysqli_fetch_assoc($result_select)) {
                  $customer_id = $row["customer_id"];
                  $customer_fname = $row["firstname"];
                  $customer_lname = $row["lastname"];
                  $customer_username = $row["username"];
                  $customer_email = $row["email"];
                  $serial_no++;
              ?>
                  <tr>
                    <td class='id'><?php echo $serial_no; ?></td>
                    <td><?php echo $customer_id; ?></td>
                    <td><?php echo $customer_fname; ?></td>
                    <td><?php echo $customer_lname; ?></td>
                    <td><?php echo $customer_username; ?></td>
                    <td><?php echo $customer_email; ?></td>
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