<?php include "header.php"; ?>
<?php $err = ""; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">

                <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <?php
                    if (isset($_REQUEST["err"])) {
                        $getErr = $_REQUEST["err"];
                        if ($getErr == "emptyFields") {
                            $err = "all fields are required.";
                        } else if ($getErr == "cannotUpdate") {
                            $err = "something went wrong to update this category data.";
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
                        if (allDataWithElement($connect, "category", "category_id", $edit_id) == false) {
                            header("location: category.php");
                            die();
                        }
                        $result_select = allDataWithElement($connect, "category", "category_id", $edit_id);
                        while ($row = mysqli_fetch_assoc($result_select)) {
                            $category_id = $row["category_id"];
                            $category_name = $row["category_name"];
                            $category_product = $row["product"];
                        }
                    }
                    ?>
                    <?php
                    if (isset($_REQUEST["submit"])) {
                        $update_category_name = mysqli_real_escape_string($connect, $_REQUEST["category_name"]);
                        if (emptyCategory($update_category_name) == false) {
                            header("location: update-category.php?edit_id=$edit_id&err=emptyFields");
                        } else {
                            if (updateCategory($connect, $edit_id, $update_category_name) == false) {
                                header("location: update-category.php?edit_id=$edit_id&err=cannotUpdate");
                            }
                            header("location: category.php?err=successfullyUpdated");
                        }
                    }
                    ?>

                    <div class="form-group">
                        <input type="hidden" name="cat_id" class="form-control" value="<?php echo $category_id; ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="category_name" class="form-control" value="<?php echo $category_name; ?>" placeholder="">
                    </div>
                    <input type="submit" name="submit" class="btn" value="Update" />
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>