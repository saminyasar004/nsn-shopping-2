<?php include "header.php"; ?>
<?php $err = ""; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" autocomplete="off">
                    <?php
                    if (isset($_REQUEST["err"])) {
                        $getErr = $_REQUEST["err"];
                        if ($getErr == "emptyFields") {
                            $err = "all fields are required.";
                        } else if ($getErr == "cannotCreate") {
                            $err = "cannot create a new category.";
                        } else if ($getErr == "successfullyCreated") {
                            $err = "successfully created a new category.";
                        } else if ($getErr == "addCategory") {
                            $err = "you have to create a category to add a product. because you have no category on your database.";
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
                        $category_name = mysqli_real_escape_string($connect, $_REQUEST["category_name"]);
                        if (emptyCategory($category_name) == false) {
                            header("location: add-category.php?err=emptyFields");
                        } else {
                            if (addCategory($connect, $category_name) == false) {
                                header("location: add-category.php?err=cannotCreate");
                            } else {
                                header("location: category.php?err=successfullyCreated");
                            }
                        }
                    }
                    ?>
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="category_name" class="form-control" placeholder="Category Name">
                    </div>
                    <input type="submit" name="submit" class="btn" value="Add" />
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>