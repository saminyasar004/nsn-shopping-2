<?php
session_start();
unset($_SESSION["user_role"]);
unset($_SESSION["user_fullname"]);
header("location: index.php");
session_destroy();
