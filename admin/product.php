<?php include "header.php"; ?>
<?php $err = ""; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Product</h1>
            </div>
            <div class="col-md-2">
                <a class="btn" href="add-product.php">add product</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
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
                        $result_select = allDataPagination($connect, "product_info", $offset, $limit);
                        $count = mysqli_num_rows($result_select);
                        if ($count > 0) {
                            $serial_no = 0;
                            while ($row = mysqli_fetch_assoc($result_select)) {
                                $product_id = $row["id"];
                                $product_name = $row["name"];
                                $product_price = $row["price"];
                                $product_description = $row["description"];
                                $product_category_id = $row["category"];
                                $product_date = $row["date"];
                                $product_author = $row["author"];
                                $product_image = $row["img"];
                                $serial_no++;
                                $result_select_category = categoryNameById($connect, $product_category_id);
                                while ($row_category = mysqli_fetch_assoc($result_select_category)) {
                                    $product_category_name = $row_category["category_name"];
                                }
                        ?>
                                <tr>
                                    <td class="id"><?php echo $serial_no; ?></td>
                                    <td class="product_img_th"><img src="upload/<?php echo $product_image; ?>"></td>
                                    <td><?php echo $product_name; ?></td>
                                    <td><?php echo $currency . $product_price; ?></td>
                                    <td><?php echo $product_category_name; ?></td>
                                    <td><?php echo $product_date; ?></td>
                                    <td><?php echo $product_author; ?></td>
                                    <td class='edit'><a href='edit-product.php?edit_id=<?php echo $product_id; ?>'><i class='far fa-edit'></i></a></td>
                                    <td class='delete'><a onclick="return confirm('Are you want to delete this product?')" href='delete-product.php?delete_id=<?php echo $product_id; ?>&category_id=<?php echo $product_category_id; ?>&image=<?php echo $product_image; ?>'><i class='far fa-trash-alt'></i></a></td>
                                </tr>
                            <?php
                            }
                        } else {
                            $err = "there are no product on your database.";
                            $err = ucfirst($err);
                            ?>
                            <div class="php_error">
                                <?php echo $err; ?>
                            </div>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                if (isset($_REQUEST["err"])) {
                    $getErr = $_REQUEST["err"];
                    if ($getErr == "cannotDelete") {
                        $err = "cannot delete this product.";
                    } else if ($getErr == "successfullyDeleted") {
                        $err = "successfully deleted this product.";
                    } else if ($getErr == "successfullyUpdated") {
                        $err = "successfully updated product data.";
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
                $result_select = allData($connect, "product_info");
                $total_data = mysqli_num_rows($result_select);
                if ($total_data > 0) {
                    $total_page = ceil($total_data / $limit);
                    if ($total_page > 1) {
                ?>
                        <ul class='pagination admin-pagination'>
                            <?php
                            if ($current_page > 1) {
                            ?>
                                <li><a href="product.php?current_page=<?php echo $current_page - 1; ?>">⇽</a></li>
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
                                <li class="<?php echo $active_page; ?>"><a href="product.php?current_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                            }
                            if ($current_page < $total_page) {
                            ?>
                                <li><a href="product.php?current_page=<?php echo $current_page + 1; ?>">⇾</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>