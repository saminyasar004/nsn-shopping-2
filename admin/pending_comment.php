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
              <th>Product Id</th>
              <th>Rate</th>
              <th>Comment</th>
              <th>Name</th>
              <th>Email</th>
              <th>Approve</th>
              <th>Delete</th>
            </thead>
            <tbody>
              <?php
              if (isset($_REQUEST["current_page"])) {
                $current_page = $_REQUEST["current_page"];
              } else {
                $current_page = 1;
              }
              $offset = ($current_page - 1) * $limit;
              $result_select = allDataPagination($connect, "pending_comment", $offset, $limit);
              $count = mysqli_num_rows($result_select);
              if ($count > 0) {
                $serial_no = 0;
                while ($row = mysqli_fetch_assoc($result_select)) {
                  $comment_id = $row["id"];
                  $comment_product_id = $row["product_id"];
                  $comment_rate = $row["rate"];
                  $comment_message = $row["comment"];
                  $comment_name = $row["name"];
                  $comment_email = $row["email"];
                  $serial_no++;
              ?>
                  <tr>
                    <td class="id"><?php echo $serial_no; ?></td>
                    <td><?php echo $comment_product_id; ?></td>
                    <td><?php
                        $markStar = $comment_rate;
                        $unmarkStar = 5 - $comment_rate;
                        for ($i = 1; $i <= $markStar; $i++) {
                        ?>
                        <i class="fa fa-star comment-rate"></i>
                      <?php
                        }
                        for ($i = 1; $i <= $unmarkStar; $i++) {
                      ?>
                        <i class="far fa-star comment-rate"></i>
                      <?php
                        }
                      ?>
                    </td>
                    <td><?php echo $comment_message; ?></td>
                    <td><?php echo $comment_name; ?></td>
                    <td><?php echo $comment_email; ?></td>
                    <td><a href='approve_comment.php?comment_id=<?php echo $comment_id; ?>'><i class='fa fa-check'></i></a></td>
                    <td><a onclick="return confirm('Are you sure to delete this comment?')" href='delete_comment.php?comment_id=<?php echo $comment_id; ?>'><i class='far fa-trash-alt'></i></a></td>
                  </tr>
                <?php
                }
              } else {
                ?>
                <div class="php_error">
                  <?php
                  $err = "there are no comment found on your database.";
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
            if ($getErr == "cannotFindData") {
              $err = "something went wrong!";
            } else if ($getErr == "cannotApprove") {
              $err = "cannot approve this comment. please try again later";
            } else if ($getErr == "successfullyApproved") {
              $err = "successfully approved.";
            } else if ($getErr == "cannotDelete") {
              $err = "cannot delete this comment";
            } else if ($getErr == "successfullyDeleted") {
              $err = "successfully deleted this comment";
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