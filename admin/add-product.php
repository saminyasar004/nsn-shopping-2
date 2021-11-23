<?php include "header.php"; ?>
<?php $err = ""; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Product</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                    <?php
                    if (isset($_REQUEST["err"])) {
                        $getErr = $_REQUEST["err"];
                        if ($getErr == "emptyFields") {
                            $err = "all fields are required.";
                        } else if ($getErr == "productNameExist") {
                            $err = "this product is already exist on your database. please select another product name";
                        } else if ($getErr == "invalidExtension") {
                            $err = "please select a png/jpg/jpeg file to upload.";
                        } else if ($getErr == "cannotAddProduct") {
                            $err = "cannot add a new product. please try again later.";
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
                    if (isset($_REQUEST["submit"])) {
                        $product_name = mysqli_real_escape_string($connect, $_REQUEST["product_name"]);
                        $product_price = mysqli_real_escape_string($connect, $_REQUEST["product_price"]);
                        $product_description = mysqli_real_escape_string($connect, $_REQUEST["product_description"]);
                        $product_category = mysqli_real_escape_string($connect, $_REQUEST["product_category"]);
                        $product_date = date($time_format, time());
                        if ($user_role == "1") {
                            $product_author = "Admin";
                        } else {
                            $product_author = "Moderator";
                        }
                        $loc = "./upload/";
                        $product_image = $_FILES["product_img"];
                        $product_image_name = $product_image["name"];
                        $product_image_tmp_name = $product_image["tmp_name"];
                        $product_image_extension = end(explode(".", $product_image_name));
                        $valid_extensions = array("png", "jpg", "jpeg");
                        $product_image_new_name = $product_name . "." . $product_image_extension;
                        if (emptyAddProduct($product_name, $product_price, $product_description, $product_category, $product_date, $product_author, $product_image_name) == false) {
                            header("location: add-product.php?err=emptyFields");
                            die();
                        } else {
                            if (productNameExist($connect, $product_name) == false) {
                                header("location: add-product.php?err=productNameExist");
                                die();
                            } else {
                                if (in_array($product_image_extension, $valid_extensions) == false) {
                                    header("location: add-product.php?err=invalidExtension");
                                    die();
                                } else {
                                    if (addProduct($connect, $product_name, $product_price, $product_description, $product_category, $product_date, $product_author, $product_image_new_name) == false) {
                                        header("location: add-product.php?err=cannotAddProduct");
                                        die();
                                    } else {
                                        increaseCategoryProduct($connect, $product_category);
                                        move_uploaded_file($product_image_tmp_name, $loc . $product_image_new_name);
                                        header("location: product.php");
                                    }
                                }
                            }
                        }
                    }
                    ?>
                    <div class="form-group">
                        <label for="product_name">Name</label>
                        <input type="text" name="product_name" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="product_price">Price</label>
                        <input type="number" name="product_price" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="product_description"> Description</label>
                        <textarea name="product_description" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="product_category">Category</label>
                        <select name="product_category" class="form-control">
                            <option value="" selected> Select Category</option>
                            <?php
                            if (selectAllCategory($connect) == false) {
                                header("location: add-category.php?err=addCategory");
                            } else {
                                $result_select_category = selectAllCategory($connect);
                                while ($row = mysqli_fetch_assoc($result_select_category)) {
                                    $category_id = $row["category_id"];
                                    $category_name = $row["category_name"];
                            ?>
                                    <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                            <?php
                                }
                            }
                            ?>
                            <!-- <option value="null" selected> Select Category</option>
                            <option value="">Women</option>
                            <option value="">Kids</option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_img">Product image</label>
                        <input type="file" name="product_img">
                    </div>
                    <input type="submit" name="submit" class="btn" value="Add" />
                    <div class="php_error">
                    </div>
                </form>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>