<?php
if (isset($_REQUEST["product_name"])) {
  $product_title_name = $_REQUEST["product_name"];
} else {
  header("location: store.php");
  die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo ucfirst($product_title_name); ?> | Product Details | NSN Shopping | Best E-commerce Shopping Website</title>
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
  <link rel="stylesheet" href="css/product_details.css">
  <!-- linking javascript file -->
  <script src="js/index.js" defer></script>
</head>

<body>

  <!-- header section start -->

  <?php include "header.php"; ?>

  <!-- header section end -->

  <!-- overview section start -->

  <section class="overview-container">
    <div class="row">
      <?php
      if (isset($_REQUEST["product_id"])) {
        $product_id = $_REQUEST["product_id"];
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
              $product_name = $row_product_data["name"];
              $product_price = $row_product_data["price"];
              $product_description = $row_product_data["description"];
              $product_category = $row_product_data["category"];
              $product_date = $row_product_data["date"];
              $product_author = $row_product_data["author"];
              $product_img = $row_product_data["img"];
            }
            if ($product_name != $product_title_name) {
              header("location: store.php");
            }
          }
        }
      } else {
        header("location: store.php");
        die();
      }
      ?>
      <div class="img-container col1 span-1-of-2">
        <img src="admin/upload/<?php echo $product_img; ?>" id="product_img">
      </div>
      <div class="description-container col1 span-1-of-2">
        <div class="pagepath-container">
          <span class="page-path"><a href="home.php">home</a> / <a href="store.php">store</a> / <?php echo $product_name; ?></span>
        </div>
        <div class="product-title">
          <h4><?php echo $product_name; ?></h4>
        </div>
        <div class="product-price">
          <h5>$<?php echo $product_price; ?>.00</h5>
        </div>
        <div class="product-action">
          <form action="add_cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input class="quantity" min="1" max="100" type="number" name="quantity" value="1">
            <button class="btn btnSubmit" type="submit" name="submit">add to cart</button>
          </form>
        </div>
        <div class="product-description">
          <p><?php echo $product_description; ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- overview section end -->

  <!-- review section start -->

  <?php
  $result_all_comment = allCommentByProductId($connect, $product_id);
  $count_all_comment = mysqli_num_rows($result_all_comment);
  $result_all_pending_comment = allPendingCommentByProduct($connect, $product_id);
  $count_all_pending_comment = mysqli_num_rows($result_all_pending_comment);
  while ($row_all_pending_comment = mysqli_fetch_assoc($result_all_pending_comment)) {
    $pending_comment_id = $row_all_pending_comment["id"];
    $pending_comment_product_id = $row_all_pending_comment["product_id"];
    $pending_comment_rate = $row_all_pending_comment["rate"];
    $pending_comment_message = $row_all_pending_comment["comment"];
    $pending_comment_name = $row_all_pending_comment["name"];
    $pending_comment_email = $row_all_pending_comment["email"];
  }
  ?>

  <section class="review-section">
    <div class="row">
      <div class="review-header">
        <h5>reviews (<?php echo $count_all_comment; ?>)</h5>
      </div>
      <div class="review-show">
        <div class="review-show-header">
          <h4>reviews</h4>
        </div>
        <?php
        if ($count_all_comment > 0) {
          while ($row_all_comment = mysqli_fetch_assoc($result_all_comment)) {
            $comment_id = $row_all_comment["id"];
            $comment_product_id = $row_all_comment["product_id"];
            $comment_rate = $row_all_comment["rate"];
            $comment_message = $row_all_comment["comment"];
            $comment_name = $row_all_comment["name"];
            $comment_email = $row_all_comment["email"];

        ?>
            <div class="review-show-content-wrapper">
              <div class="review-image">
                <img src="./img/comment-user.png" id="comment-img">
              </div>
              <div class="review-content">
                <div class="review-content-para">
                  <p><?php echo $comment_name ?></p>
                </div>
                <div class="review-content-rating">
                  <?php
                  $markStar = $comment_rate;
                  $unmarkStar = 5 - $comment_rate;
                  for ($i = 1; $i <= $markStar; $i++) {
                  ?>
                    <i class="fa fa-star"></i>
                  <?php
                  }
                  for ($i = 1; $i <= $unmarkStar; $i++) {
                  ?>
                    <i class="far fa-star"></i>
                  <?php
                  }
                  ?>
                </div>
                <div class="review-content-comment">
                  <p><?php echo $comment_message; ?></p>
                </div>
              </div>
            </div>
        <?php
          }
        }
        ?>
        <?php
        if ($count_all_comment == 0 && !isset($_REQUEST["err"])) {
        ?>
          <div class="review-show-content-wrapper">
            <p>there are no reviews yet</p>
          </div>
        <?php
        }
        ?>
        <?php
        if (isset($_REQUEST["err"])) {
          $getErr = $_REQUEST["err"];
          if ($getErr == "commented" && $count_all_pending_comment > 0) {
        ?>
            <div class="review-show-content-wrapper">
              <div class="review-image">
                <img src="./img/comment-user.png" id="comment-img">
              </div>
              <div class="review-content">
                <div class="review-content-para">
                  <p id="pending-comment-para">your review is awaiting approval</p>
                </div>
                <div class="review-content-rating">
                  <?php
                  $markStar = $pending_comment_rate;
                  $unmarkStar = 5 - $pending_comment_rate;
                  for ($i = 1; $i <= $markStar; $i++) {
                  ?>
                    <i class="fa fa-star"></i>
                  <?php
                  }
                  for ($i = 1; $i <= $unmarkStar; $i++) {
                  ?>
                    <i class="far fa-star"></i>
                  <?php
                  }
                  ?>
                </div>
                <div class="review-content-comment">
                  <p id="pending-comment-para"><?php echo $pending_comment_message; ?></p>
                </div>
              </div>
            </div>
        <?php
          }
        }
        ?>
        <div class="review-submit-container">
          <div class="review-submit-header">
            <h4><?php
                if ($count_all_comment == 0) {
                ?>
                Be the first to review to "<?php echo $product_name; ?>"
              <?php
                } else {
              ?>
                Add a review to "<?php echo $product_name; ?>"
              <?php
                }
              ?></h4>
            <p>Your email address will not be published. Required fields are marked *</p>
          </div>
          <div class="review-submit-rating">
            <div class="review-submit-rating-header">
              <span>your rating *</span>
            </div>
            <div class="review-submit-rating-icon">
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
            </div>
          </div>
          <div class="review-form-container">
            <form action="add_comment.php" method="post" autocomplete="off">
              <div class="form-group">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                <input class="rating-input" type="hidden" name="rate" value="">
                <label for="comment-box">your review *</label>
                <textarea name="comment" id="comment-box" cols="5" rows="2"></textarea>
              </div>
              <div class="form-group">
                <div class="form-col">
                  <label for="name">name *</label>
                  <input type="name" name="name" id="name">
                </div>
                <div class="form-col">
                  <label for="email">email *</label>
                  <input type="email" name="email" id="email">
                </div>
              </div>
              <div class="form-group">
                <p>my name, email, and website in this browser for the next time I comment.</p>
              </div>
              <div class="form-group">
                <input class="btn" type="submit" name="submit" value="Submit">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- review section end -->

  <!-- footer section start -->

  <?php include "footer.php"; ?>

  <!-- footer section end -->

  <script src="js/product_details.js"></script>
</body>

</html>