<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | NSN Shopping | Best E-commerce Shopping Website</title>
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
    <link rel="stylesheet" href="css/store.css">
    <!-- linking javascript file -->
    <script src="js/index.js" defer></script>
</head>

<body>

    <!-- header section start -->

    <?php include "header.php"; ?>

    <!-- header section end -->

    <!-- product section start -->

    <section class="productSection">
        <div class="row">
            <div class="productHeader">
                <h2>our all products</h2>
            </div>
        </div>
        <div class="row">
            <div class="productContainer">
                <?php
                if (isset($_REQUEST["err"])) {
                    $getErr = $_REQUEST["err"];
                    if ($getErr == "notFound") {
                        $err = "our store is now empty.";
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
                <?php
                if (isset($_REQUEST["current_page"])) {
                    $current_page = $_REQUEST["current_page"];
                } else {
                    $current_page = 1;
                }
                $limit = 12;
                $Offset = ($current_page - 1) * $limit;
                if (allDataPagination($connect, "product_info", $Offset, $limit) == false) {
                    header("location: store.php?err=notFound");
                } else {
                    $result_select_product = allDataPagination($connect, "product_info", $Offset, $limit);
                    while ($row_select_product = mysqli_fetch_assoc($result_select_product)) {
                        $product_id = $row_select_product["id"];
                        $product_name = $row_select_product["name"];
                        $product_price = $row_select_product["price"];
                        $product_description = $row_select_product["description"];
                        $product_category = $row_select_product["category"];
                        $product_date = $row_select_product["date"];
                        $product_author = $row_select_product["author"];
                        $product_img = $row_select_product["img"];
                ?>
                        <div class="co1 span-1-of-4 productBox">
                            <a href="product_details.php?product_id=<?php echo $product_id; ?>&product_name=<?php echo $product_name; ?>">
                                <div class="productImage">
                                    <img src="admin/upload/<?php echo $product_img; ?>">
                                </div>
                                <div class="productName">
                                    <h4><?php echo $product_name; ?></h4>
                                </div>
                                <div class="productStatus">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="productPrice">
                                    <h5><?php echo $currency . $product_price; ?></h5>
                                </div>
                            </a>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="paginationContainer">
                <?php
                $result_select_page = allData($connect, "product_info");
                $total_data = mysqli_num_rows($result_select_page);
                $total_page = ceil($total_data / $limit);
                if ($total_page > 1) {
                ?>
                    <ul class='pagination store-pagination'>
                        <?php
                        if ($current_page > 1) {
                        ?>
                            <li><a href="store.php?current_page=<?php echo $current_page - 1; ?>">⇽</a></li>
                        <?php
                        }
                        $active_link = "";
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($current_page == $i) {
                                $active_link = "active";
                            } else {
                                $active_link = "";
                            }
                        ?>
                            <li class="<?php echo $active_link; ?>"><a href="store.php?current_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                        }
                        if ($current_page < $total_page) {
                        ?>
                            <li><a href="store.php?current_page=<?php echo $current_page + 1; ?>">⇾</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                <?php
                }
                ?>
                <!-- <ul class='pagination store-pagination'>
                    <li class="active"><a href="store.php">⇽</a></li>
                    <li class=""><a href="store.php">1</a></li>
                    <li class=""><a href="store.php">2</a></li>
                    <li><a href="store.php">⇾</a></li>
                </ul> -->
            </div>
        </div>
    </section>

    <!-- product section end -->

    <!-- footer section start -->

    <?php include "footer.php"; ?>

    <!-- footer section end -->

</body>

</html>