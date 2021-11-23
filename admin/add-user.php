<?php include "header.php"; ?>
<?php $err = ""; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add User</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <?php
                if (isset($_REQUEST["submit"])) {
                    $fname = mysqli_real_escape_string($connect, $_REQUEST["fname"]);
                    $lname = mysqli_real_escape_string($connect, $_REQUEST["lname"]);
                    $username = mysqli_real_escape_string($connect, $_REQUEST["username"]);
                    $email = mysqli_real_escape_string($connect, $_REQUEST["email"]);
                    $password = mysqli_real_escape_string($connect, hashPassword($_REQUEST["password"]));
                    $role = mysqli_real_escape_string($connect, $_REQUEST["role"]);
                    if (emptyAddUser($fname, $lname, $username, $email, $password) == false) {
                        header("location: add-user.php?err=emptyAddUser");
                        die();
                    }
                    if (usernameExist($connect, $username) == false) {
                        header("location: add-user.php?err=usernameExist");
                        die();
                    }
                    if (emailExist($connect, $email) == false) {
                        header("location: add-user.php?err=emailExist");
                        die();
                    }
                    if (addUser($connect, $fname, $lname, $username, $email, $password, $role) == false) {
                        header("location: add-user.php?err=cannotAddUser");
                        die();
                    } else {
                        header("location: users.php");
                    }
                }
                ?>
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" autocomplete="off">
                    <?php
                    if (isset($_REQUEST["err"])) {
                        $getErr = $_REQUEST["err"];
                        if ($getErr == "emptyAddUser") {
                            $err = "all fields are required.";
                        } else if ($getErr == "usernameExist") {
                            $err = "this username is already taken. please use another one.";
                        } else if ($getErr == "emailExist") {
                            $err = "this email is already taken. please use another one.";
                        } else if ($getErr == "cannotAddUser") {
                            $err = "something went wrong. please try again later.";
                        } else {
                            $err = "";
                        }
                        $err = ucfirst($err);
                    ?>
                        <div class="php_error">
                            <?php
                            echo $err;
                            ?>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="0">Moderator</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn" value="Add" />
                </form>
                <!-- Form End-->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>