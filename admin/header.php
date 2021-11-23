<?php
include "./connect.php";
include "./functions.php";
if (!isset($_SESSION["user_role"]) && !isset($_SESSION["user_fullname"])) {
    header("location: index.php");
} else {
    autoLogout();
    $user_role = $_SESSION["user_role"];
    $user_fullname = $_SESSION["user_fullname"];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Admin Panel</title>
        <!-- favicon icon -->
        <link rel="icon" href="./images/cart.png" type="image/x-icon">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="./css/bootstrap.min.css" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="./icon/css/all.min.css">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="./css/style.css">
    </head>

    <body>
        <!-- HEADER -->
        <div id="header-admin">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-2">
                        <a target="blank" href="../home.php"><img class="logo" src="images/logo.png"></a>
                    </div>
                    <!-- /LOGO -->
                    <!-- LOGO-Out -->
                    <div class="col-md-offset-9  col-md-1 Adminmenu">
                        <span class="username"><?php echo $user_fullname; ?></span><a href="logout.php" class="admin-logout">logout</a>
                    </div>
                    <!-- /LOGO-Out -->
                </div>
            </div>
        </div>
        <!-- /HEADER -->
        <!-- Menu Bar -->
        <div id="admin-menubar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <ul class="admin-menu">
                                <li>
                                    <a href="product.php">Product</a>
                                </li>
                                <li>
                                    <a href="category.php">Category</a>
                                </li>
                                <?php
                                if ($user_role == "1") {
                                ?>
                                    <li>
                                        <a href="users.php">Users</a>
                                    </li>
                                    <li>
                                        <a href="customers.php">customers</a>
                                    </li>
                                    <li>
                                        <a href="orders.php">orders</a>
                                    </li>
                                    <li>
                                        <a href="pending_comment.php">pending comment</a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                            <center>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Menu Bar -->
    <?php
}
    ?>