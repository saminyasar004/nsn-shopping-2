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
                <div class="col-md-12">
                    <h1 class="admin-heading">Modify User Details</h1>
                </div>
                <div class="col-md-offset-4 col-md-4">
                    <!-- Form Start -->
                    <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" autocomplete="off">
                        <?php
                        if (isset($_REQUEST["err"])) {
                            $getErr = $_REQUEST["err"];
                            if ($getErr == "cannotUpdate") {
                                $err = "something went wrong. please try again later.";
                            } else if ($getErr == "emptyFields") {
                                $err = "all fields are required.";
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
                            if (allDataWithElement($connect, "user", "user_id", $edit_id) == false) {
                                header("location: users.php");
                                die();
                            }
                            $result_select = allDataWithElement($connect, "user", "user_id", $edit_id);
                            while ($row = mysqli_fetch_assoc($result_select)) {
                                $edit_fname = $row["first_name"];
                                $edit_lname = $row["last_name"];
                                $edit_username = $row["username"];
                                $edit_email = $row["email"];
                                $edit_role = $row["role"];
                            }
                        }
                        if (isset($_REQUEST["submit"])) {
                            $update_fname = mysqli_real_escape_string($connect, $_REQUEST["fname"]);
                            $update_lname = mysqli_real_escape_string($connect, $_REQUEST["lname"]);
                            $update_username = mysqli_real_escape_string($connect, $_REQUEST["username"]);
                            $update_email = mysqli_real_escape_string($connect, $_REQUEST["email"]);
                            $update_role = mysqli_real_escape_string($connect, $_REQUEST["role"]);
                            if (emptyUpdateUser($update_fname, $update_lname, $update_username, $update_email) == false) {
                                header("location: update-user.php?edit_id=$edit_id&err=emptyFields");
                            } else {
                                if (updateUser($connect, $edit_id, $update_fname, $update_lname, $update_username, $update_email, $update_role) == false) {
                                    header("location: update-user.php?edit_id=$edit_id&err=cannotUpdate");
                                }
                                header("location: users.php?err=successfullyUpdated");
                            }
                        }
                        ?>
                        <div class="form-group">
                            <input type="hidden" name="user_id" class="form-control" value="" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="fname" class="form-control" value="<?php echo $edit_fname; ?>" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control" value="<?php echo $edit_lname; ?>" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $edit_username; ?>" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $edit_email; ?>" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>User Role</label>
                            <select class="form-control" name="role" value="<?php echo $edit_role; ?>">
                                <?php
                                if ($edit_role == "0") {
                                ?>
                                    <option value="0" selected>Moderator</option>
                                    <option value="1">Admin</option>
                                <?php
                                } else if ($edit_role == "1") {
                                ?>
                                    <option value="0">Moderator</option>
                                    <option value="1" selected>Admin</option>
                                <?php
                                }
                                ?>
                                <!-- <option value="0">Moderator</option>
                                <option value="1">Admin</option> -->
                            </select>
                        </div>
                        <input type="submit" name="submit" class="btn" value="Update" />
                    </form>
                    <!-- /Form -->
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<?php include "footer.php"; ?>