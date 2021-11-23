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
                <div class="col-md-10">
                    <h1 class="admin-heading">All Users</h1>
                </div>
                <div class="col-md-2">
                    <a class="btn" href="add-user.php">add user</a>
                </div>
                <div class="col-md-12">
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Full Name</th>
                            <th>User Name</th>
                            <th>Role</th>
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
                            $result_select = allDataPagination($connect, "user", $offset, $limit);
                            $count = mysqli_num_rows($result_select);
                            if ($count > 0) {
                                $serial_no = 0;
                                while ($row = mysqli_fetch_assoc($result_select)) {
                                    $user_id = $row["user_id"];
                                    $user_fname = $row["first_name"];
                                    $user_lname = $row["last_name"];
                                    $user_user_fullname = ucfirst($user_fname) . " " . ucfirst($user_lname);
                                    $user_username = $row["username"];
                                    $user_email = $row["email"];
                                    $user_role = $row["role"];
                                    $serial_no++;
                            ?>
                                    <tr>
                                        <td class='id'><?php echo $serial_no; ?></td>
                                        <td><?php echo $user_user_fullname; ?></td>
                                        <td><?php echo $user_username; ?></td>
                                        <td><?php
                                            if ($user_role == "1") {
                                                echo "Admin";
                                            } else {
                                                echo "Moderator";
                                            }
                                            ?></td>
                                        <td class='edit'><a href='update-user.php?edit_id=<?php echo $user_id; ?>'><i class='far fa-edit'></i></a></td>
                                        <td class='delete'><a onclick="return confirm('Are you sure to delete this user from your database?')" href='delete-user.php?delete_id=<?php echo $user_id; ?>'><i class='far fa-trash-alt'></i></a></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <div class="php_error">
                                    <?php
                                    $err = "there are no user found on your database.";
                                    $err = ucfirst($err);
                                    echo $err;
                                    ?>
                                </div>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                    $result_select = allData($connect, "user");
                    $total_data = mysqli_num_rows($result_select);
                    $total_page = ceil($total_data / $limit);
                    if ($total_page > 1) {
                    ?>
                        <ul class='pagination admin-pagination'>
                            <?php
                            if ($current_page > 1) {
                            ?>
                                <li><a href="users.php?current_page=<?php echo $current_page - 1; ?>">⇽</a></li>
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
                                <li class="<?php echo $active_page; ?>"><a href="users.php?current_page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                            }
                            if ($current_page < $total_page) {
                            ?>
                                <li><a href="users.php?current_page=<?php echo $current_page + 1; ?>">⇾</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($_REQUEST["err"])) {
                        $getErr = $_REQUEST["err"];
                        if ($getErr == "successfullyUpdated") {
                            $err = "successfully updated.";
                        } else if ($getErr == "cannotDelete") {
                            $err = "cannot delete this user.";
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
                    <!-- <ul class='pagination admin-pagination'>
                        <li><a href="users.php">⇽</a></li>
                        <li class=""><a href="users.php">1</a></li>
                        <li class=""><a href="users.php">2</a></li>
                        <li><a href="users.php">⇾</a></li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<?php include "footer.php"; ?>