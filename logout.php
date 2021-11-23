<?php
session_start();
unset($_SESSION["customer_id"]);
unset($_SESSION["customer_username"]);
unset($_SESSION["customer_fullname"]);
unset($_SESSION["current_time"]);
header("location: account.php");
session_destroy();
