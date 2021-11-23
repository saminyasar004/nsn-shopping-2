<?php include "include/connect.php"; ?>
<?php include "include/functions.php"; ?>
<?php $err = ""; ?>

<?php
if (isset($_SESSION["customer_id"])) {
    $customer_username = $_SESSION["customer_username"];
    $customer_id = $_SESSION["customer_id"];
    $result_cart_number = selectCartByAuthor($connect, $customer_username);
    $count_cart_number = mysqli_num_rows($result_cart_number);
    if ($count_cart_number == false) {
        $count_cart_number = 0;
    }
} else {
    $count_cart_number = 0;
}
?>

<!-- header section start -->

<header class="headerSection">
    <div class="row">
        <div class="navContainer">
            <nav>
                <div class="logo">
                    <a href="./home.php">
                        <img src="img/nsn.png" alt="NSN Shopping">
                    </a>
                </div>
                <div class="navLinks">
                    <ul>
                        <?php
                        $all_nav_links = ["home", "store", "account", "contact"];
                        if ($count_cart_number > 0) {
                            array_push($all_nav_links, "checkout");
                        }
                        $all_nav_links_length = count($all_nav_links);
                        $full_path = $_SERVER["REQUEST_URI"];
                        $current_page_path = explode("/", $full_path);
                        $current_page_name = end($current_page_path);
                        $current_page_full_name = explode(".", $current_page_name);
                        $current_page_name = reset($current_page_full_name);
                        $active_class = "";
                        if ($current_page_name == "") {
                            $current_page_name = "home";
                        }
                        for ($i = 0; $i < $all_nav_links_length; $i++) {
                            if ($all_nav_links[$i] == $current_page_name) {
                                $active_class = "activeLink";
                            } else if ($current_page_name == "reset_password") {
                                if ($all_nav_links[$i] == "account") {
                                    $active_class = "activeLink";
                                } else {
                                    $active_class = "";
                                }
                            } else if ($current_page_name == "dashboard") {
                                if ($all_nav_links[$i] == "account") {
                                    $active_class = "activeLink";
                                } else {
                                    $active_class = "";
                                }
                            } else if ($current_page_name == "order") {
                                if ($all_nav_links[$i] == "account") {
                                    $active_class = "activeLink";
                                } else {
                                    $active_class = "";
                                }
                            } else if ($current_page_name == "account_details") {
                                if ($all_nav_links[$i] == "account") {
                                    $active_class = "activeLink";
                                } else {
                                    $active_class = "";
                                }
                            } else if ($current_page_name == "product_details") {
                                if ($all_nav_links[$i] == "store") {
                                    $active_class = "activeLink";
                                } else {
                                    $active_class = "";
                                }
                            } else {
                                $active_class = "";
                            }
                        ?>
                            <li><a class="<?php echo $active_class; ?>" href="<?php echo $all_nav_links[$i]; ?>.php"><?php echo $all_nav_links[$i]; ?></a></li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($current_page_name == "cart") {
                            $active_class = "activeCount";
                        } else {
                            $active_class = "";
                        }
                        ?>
                        <li><a href="cart.php"><span class="count <?php echo $active_class; ?>"><?php echo $count_cart_number; ?></span></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>

<!-- header section end -->