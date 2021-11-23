<?php include "header.php"; ?>
<?php $err = ""; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Product</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form for show edit-->
                <form action="update-product.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <?php
                    if (isset($_REQUEST["err"])) {
                        $getErr = $_REQUEST["err"];
                        if ($getErr == "invalidExtension") {
                            $err = "please select png/jpg/jpeg file to upload.";
                        } else if ($getErr == "cannotUpdate") {
                            $err = "cannot update this product data.";
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
                    if (isset($_REQUEST["edit_id"])) {
                        $edit_id = $_REQUEST["edit_id"];
                        if (allDataWithElement($connect, "product_info", "id", $edit_id) == false) {
                            header("location: product.php");
                        } else {
                            $result_select_product = allDataWithElement($connect, "product_info", "id", $edit_id);
                            while ($row_select_product = mysqli_fetch_assoc($result_select_product)) {
                                $product_id = $row_select_product["id"];
                                $product_name = $row_select_product["name"];
                                $product_price = $row_select_product["price"];
                                $product_description = $row_select_product["description"];
                                $product_category = $row_select_product["category"];
                                $product_img = $row_select_product["img"];
                            }
                        }
                    }
                    ?>
                    <div class="form-group">
                        <input type="hidden" name="product_id" class="form-control" value="<?php echo $product_id; ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="product_author" class="form-control" value="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="product_name">Name</label>
                        <input type="text" name="product_name" class="form-control" id="exampleInputUsername" value="<?php echo $product_name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="product_price">Price</label>
                        <input type="number" name="product_price" class="form-control" id="exampleInputUsername" value="<?php echo $product_price; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea name="product_description" class="form-control" rows="5"><?php echo $product_description; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCategory">Category</label>
                        <input type="hidden" name="old_product_category" class="form-control" value="<?php echo $product_category; ?>" placeholder="">
                        <select class="form-control" name="new_product_category">
                            <?php
                            if (selectAllCategory($connect) == false) {
                                header("location: product.php");
                            } else {
                                $result_category = selectAllCategory($connect);
                                while ($row_category = mysqli_fetch_assoc($result_category)) {
                                    $category_id = $row_category["category_id"];
                                    $category_name = $row_category["category_name"];
                                    if ($category_id == $product_category) {
                            ?>
                                        <option selected value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                            <?php
                                    }
                                }
                            }
                            ?>
                            <!-- <option value="">Men</option>
                            <option value="">Women</option>
                            <option value="">Kids</option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Product image</label>
                        <input type="file" name="new_image">
                        <img src="./upload/<?php echo $product_img; ?>" height="150px">
                        <input type="hidden" name="old_image" value="<?php echo $product_img; ?>">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                </form>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>