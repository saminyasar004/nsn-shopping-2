<?php include "header.php"; ?>
<?php $err = ""; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="btn" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>No. of Products</th>
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
                        $result_select_pagination = allDataPagination($connect, "category", $offset, $limit);
                        $count = mysqli_num_rows($result_select_pagination);
                        if ($count > 0) {
                            $serial_no = 0;
                            while ($row = mysqli_fetch_assoc($result_select_pagination)) {
                                $category_id = $row["category_id"];
                                $category_name = $row["category_name"];
                                $category_product = $row["product"];
                                $serial_no++;
                        ?>
                                <tr>
                                    <td class='id'><?php echo $serial_no; ?></td>
                                    <td><?php echo $category_id; ?></td>
                                    <td><?php echo $category_name; ?></td>
                                    <td><?php echo $category_product; ?></td>
                                    <td class='edit'><a href='update-category.php?edit_id=<?php echo $category_id; ?>'><i class='far fa-edit'></i></a></td>
                                    <td class='delete'><a onclick="return confirm('Are you sure to delete this category?')" href='delete-category.php?delete_id=<?php echo $category_id; ?>'><i class='far fa-trash-alt'></i></a></td>
                                </tr>
                            <?php
                            }
                        } else {
                            $err = "you have no category on your database.";
                            ?>
                            <div class="php_error">
                                <?php echo $err; ?>
                            </div>
                        <?php
                        }
                        ?>
                        <!-- <tr>
                            <td class='id'>1</td>
                            <td>2</td>
                            <td>Men</td>
                            <td>0</td>
                            <td class='edit'><a href='update-category.php'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a onclick="return confirm('Are you sure to delete this category?')" href='delete-category.php'><i class='fa fa-trash-o'></i></a></td>
                        </tr> -->
                    </tbody>
                </table>

                <?php
                if (isset($_REQUEST["err"])) {
                    $getErr = $_REQUEST["err"];
                    if ($getErr == "successfullyCreated") {
                        $err = "successfully created a new category.";
                    } else if ($getErr == "cannotFindData") {
                        $err = "cannot find any category on your database.";
                    } else if ($getErr == "successfullyDeleted") {
                        $err = "successfully deleted this category.";
                    } else if ($getErr == "cannotDelete") {
                        $err = "cannot delete this category.";
                    } else if ($getErr == "successfullyUpdated") {
                        $err = "successfully updated.";
                    } else if ($getErr == "productHave") {
                        $number_of_category_product = $_REQUEST["numberOfProduct"];
                        if ($number_of_category_product > 1) {
                            $err = "there are $number_of_category_product products in this category. so you cannot delete this category.";
                        } else {
                            $err = "there are $number_of_category_product product in this category. so you cannot delete this category.";
                        }
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
                $result_all_select = allData($connect, "category");
                $total_data = mysqli_num_rows($result_all_select);
                $total_page = ceil($total_data / $limit);
                if ($total_page > 1) {
                ?>
                    <ul class='pagination admin-pagination'>
                        <?php
                        if ($current_page > 1) {
                        ?>
                            <li><a href="category.php?current_page=<?php echo $current_page - 1; ?>">⇽</a></li>
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
                            <li class="<?php echo $active_page; ?>"><a href="category.php?current_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                        }
                        if ($current_page < $total_page) {
                        ?>
                            <li><a href="category.php?current_page=<?php echo $current_page + 1; ?>">⇾</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                <?php
                }
                ?>
                <!-- <ul class='pagination admin-pagination'>
                    <li><a href="category.php">⇽</a></li>
                    <li class=""><a href="category.php">1</a></li>;
                    <li class=""><a href="category.php">2</a></li>;
                    <li><a href="category.php">⇾</a></li>
                </ul> -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>