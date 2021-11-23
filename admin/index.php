<?php
include "./connect.php";
include "./functions.php";
if (isset($_SESSION["user_role"]) && isset($_SESSION["user_fullname"])) {
    header("location: product.php");
} else {
?>
    <?php $err = ""; ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin | Login</title>
        <!-- favicon icon -->
        <link rel="icon" href="./images/cart.png" type="image/x-icon">
        <!-- bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="./icon/css/all.min.css">
        <!-- custom stylesheet -->
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <a target="blank" href="../home.php">
                            <img class="logo" src="./images/logo.png">
                        </a>
                        <h3 class="heading">Login</h3>
                        <!-- Form Start -->
                        <?php
                        if (isset($_REQUEST["submit"])) {
                            $username = mysqli_real_escape_string($connect, $_REQUEST["username"]);
                            $password = mysqli_real_escape_string($connect, hashPassword($_REQUEST["password"]));
                            if (emptyLogin($username, $password) == false) {
                                header("location: index.php?err=emptyLogin");
                                die();
                            }
                            if (userLogin($connect, $username, $password) == false) {
                                header("location: index.php?err=incorrectLoginDetails");
                                die();
                            }
                            $result_select = userLogin($connect, $username, $password);
                            while ($row = mysqli_fetch_assoc($result_select)) {
                                $user_id = $row["user_id"];
                                $user_fname = $row["first_name"];
                                $user_lname = $row["last_name"];
                                $user_username = $row["username"];
                                $user_email = $row["email"];
                                $user_role = $row["role"];
                                $user_fullname = ucfirst($user_fname) . " " . ucfirst($user_lname);
                                $_SESSION["user_role"] = $user_role;
                                $_SESSION["user_fullname"] = $user_fullname;
                                $_SESSION["current_time"] = time();
                            }
                            header("location: product.php");
                        }
                        ?>
                        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" autocomplete="off">
                            <?php
                            if (isset($_REQUEST["err"])) {
                                $getErr = $_REQUEST["err"];
                                if ($getErr == "emptyLogin") {
                                    $err = "all fields are required.";
                                } else if ($getErr == "incorrectLoginDetails") {
                                    $err = "please enter your correct login details.";
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
                                <label>Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <input type="submit" name="submit" class="btn btn-login" value="login" />
                        </form>
                        <!-- /Form  End -->
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php
}
?>