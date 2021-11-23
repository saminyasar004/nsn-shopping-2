<?php

/**
 * all functionality defined in this file for this project
 * hashPassword funciton use to hash password
 * unhashPassword function use to unhash password
 * seePassword function use to return user password
 * autoLogout function use to logout automatically after unactivity
 * emptyRegister function use to see if the register form is empty
 * emailExist function use to see the given email is allready exist or not
 * usernameExist function use to see the given username is allready exist or not
 * createAccount function use to create a new account on our database
 * emptyUpdateAccount function use to see if the update form empty
 * updateUsernameExist function use to see if the username is taken or not
 * updateEmailExist function use to see if the update form email is taken or not
 * updateAccount function use to update an existing customer account data
 * updateAccountWithPassword function use to update an existing customer account
 * emptyLogin function use to see if the login form is empty
 * loginCustomer function use to login a customer in his own account
 * customerData function use to fetch one customer data
 * allData function use to fetch all data from database
 * allDataPagination use to feth all data with pagination from database
 * productById function use to fetch all data of a given product id
 * cartNumber function use to see the how many products are exist on cart
 * insertCart function use to add a new product on customer cart page
 * selectCartById function use to select a certain cart
 * updateCart function use to update existing cart info
 * deleteCart function use to delete a product from cart
 * selectCartByAuthor function use to select corresponding customer cart
 * selectOrderByAuthor function use to fetch all data by author
 * insertOrder function use to replace all cart product info into order info
 * deleteOrder function use to delete the selected order from database
 * clearCart function use to swith cart detail to order
 * emptyComment function use to see if the comment fields are empty
 * allPendingCommentByProduct funcion use to fetch a particular product's comment
 * addPendingComment function use to add a new comment in pending list
 * allCommentByProductId function use to see the comments on the product
 */

function hashPassword($password)
{
  $result = base64_encode($password);
  return $result;
}

function unhashPassword($password)
{
  $result = base64_decode($password);
  return $result;
}

function seePassword($connect, $username)
{
  $result = "";
  $query_select = "SELECT password FROM customer_info WHERE username = '$username'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $result = $result_select;
  } else {
    $result = false;
  }
  return $result;
}

function autoLogout()
{
  $current_time = $_SESSION["current_time"];
  $limit = 5000;
  if ((time() - $current_time) > $limit) {
    header("location: logout.php");
  }
}

function emptyRegister($email, $username, $password)
{
  $result = "";
  if (empty($email) or empty($username) or empty($password)) {
    $result = false;
  } else {
    $result = true;
  }
  return $result;
}

function emailExist($connect, $email)
{
  $result = "";
  $query_select = "SELECT * FROM customer_info WHERE email = '$email'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $count_select = mysqli_num_rows($result_select);
    if ($count_select > 0) {
      $result = false;
    } else {
      $result = true;
    }
  } else {
    $result = false;
  }
  return $result;
}

function usernameExist($connect, $username)
{
  $result = "";
  $query_select = "SELECT * FROM customer_info WHERE username = '$username'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $count_select = mysqli_num_rows($result_select);
    if ($count_select > 0) {
      $result = false;
    } else {
      $result = true;
    }
  } else {
    $result = false;
  }
  return $result;
}

function createAccount($connect, $email, $username, $password)
{
  $result = "";
  $query_insert = "INSERT INTO customer_info (firstname, lastname, username, email, password) VALUES ('', '', '$username', '$email', '$password')";
  $result_insert = mysqli_query($connect, $query_insert);
  if ($result_insert) {
    $query_select = "SELECT * FROM customer_info WHERE username = '$username'";
    $result_select = mysqli_query($connect, $query_select);
    if ($result_select) {
      $result = $result_select;
    } else {
      $result = false;
    }
  } else {
    $result = false;
  }
  return $result;
}

function emptyUpdateAccount($fname, $lname, $username, $email)
{
  $result = "";
  if (empty($fname) or empty($lname) or empty($username) or empty($email)) {
    $result = false;
  } else {
    $result = true;
  }
  return $result;
}

function updateUsernameExist($connect, $username)
{
  $result = "";
  $query_select = "SELECT * FROM customer_info WHERE username = '$username'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $count_select = mysqli_num_rows($result_select);
    if ($count_select > 0) {
      $result = false;
    } else {
      $result = true;
    }
  } else {
    $result = false;
  }
  return $result;
}

function updateEmailExist($connect, $email)
{
  $result = "";
  $query_select = "SELECT * FROM customer_info WHERE email = '$email'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $count_select = mysqli_num_rows($result_select);
    if ($count_select > 0) {
      $result = false;
    } else {
      $result = true;
    }
  } else {
    $result = false;
  }
  return $result;
}

function updateAccount($connect, $id, $fname, $lname)
{
  $result = "";
  $query_update = "UPDATE customer_info SET firstname = '$fname', lastname = '$lname' WHERE customer_info.customer_id = '$id'";
  $result_update = mysqli_query($connect, $query_update);
  if ($result_update) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function updateAccountWithPassword($connect, $id, $fname, $lname, $password)
{
  $result = "";
  $query_update = "UPDATE customer_info SET firstname = '$fname', lastname = '$lname', password = '$password' WHERE customer_info.customer_id = '$id'";
  $result_update = mysqli_query($connect, $query_update);
  if ($result_update) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function emptyLogin($username, $password)
{
  $result = "";
  if (empty($username) or empty($password)) {
    $result = false;
  } else {
    $result = true;
  }
  return $result;
}

function loginCustomer($connect, $username, $password)
{
  $result = "";
  $query_select = "SELECT * FROM customer_info WHERE username = '$username' AND password = '$password'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $count_select = mysqli_num_rows($result_select);
    if ($count_select > 0) {
      $result = $result_select;
    } else {
      $result = false;
    }
  } else {
    $result = false;
  }
  return $result;
}

function customerData($connect, $id)
{
  $result = "";
  $query_select = "SELECT * FROM customer_info WHERE customer_id = '$id'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $result = $result_select;
  } else {
    $result = false;
  }
  return $result;
}

function allData($connect, $db_table)
{
  $result = "";
  $query_select = "SELECT * FROM $db_table";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $result = $result_select;
  } else {
    $result = false;
  }
  return $result;
}

function allDataPagination($connect, $db_table, $offset, $limit)
{
  $result = "";
  $query_select = "SELECT * FROM $db_table LIMIT {$offset}, {$limit}";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $result = $result_select;
  } else {
    $result = false;
  }
  return $result;
}

function productById($connect, $product_id)
{
  $result = "";
  $query_select = "SELECT * FROM product_info WHERE id = '$product_id'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $result = $result_select;
  } else {
    $result = false;
  }
  return $result;
}

function cartNumber($connect)
{
  $result = "";
  $query_select = "SELECT * FROM cart";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $count_select = mysqli_num_rows($result_select);
    $result = $count_select;
  } else {
    $result = false;
  }
  return $result;
}

function insertCart($connect, $product_id, $img, $name, $desc, $price, $quantity, $author, $date)
{
  $result = "";
  $query_insert = "INSERT INTO cart (product_id, img, name, description, price, quantity, author, date) VALUES ('$product_id', '$img', '$name', '$desc', '$price', '$quantity', '$author', '$date')";
  $result_insert = mysqli_query($connect, $query_insert);
  if ($result_insert) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function selectCartById($connect, $product_id)
{
  $result = "";
  $query_select = "SELECT id FROM cart WHERE product_id = '$product_id'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $count_select = mysqli_num_rows($result_select);
    if ($count_select > 0) {
      $result = $result_select;
    } else {
      $result = false;
    }
  } else {
    $result = false;
  }
  return $result;
}

function updateCart($connect, $id, $quantity)
{
  $result = "";
  $query_update = "UPDATE cart SET quantity = quantity + '$quantity' WHERE cart.id = '$id'";
  $result_update = mysqli_query($connect, $query_update);
  if ($result_update) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function deleteCart($connect, $delete_id)
{
  $result = "";
  $query_delete = "DELETE FROM cart WHERE id = '$delete_id'";
  $result_delete = mysqli_query($connect, $query_delete);
  if ($result_delete) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function selectCartByAuthor($connect, $author)
{
  $result = "";
  $query_select = "SELECT * FROM cart WHERE author = '$author'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $result = $result_select;
  } else {
    $result = false;
  }
  return $result;
}

function selectOrderByAuthor($connect, $author)
{
  $result = "";
  $query_select = "SELECT * FROM order_info WHERE author = '$author'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $result = $result_select;
  } else {
    $result = false;
  }
  return $result;
}

function insertOrder($connect, $product_id, $product_name, $product_price, $product_quantity, $product_author, $firstname, $lastname, $country, $street_address, $city, $postcode, $phone, $email, $payment_method, $subtotal, $vat, $grand_total, $date)
{
  $result = "";
  $query_insert = "INSERT INTO order_info (product_id, name, price, quantity, author, firstname, lastname, country, street_address, city, postcode, phone, email, payment_method, subtotal, vat, grand_total, date) VALUES ('$product_id','$product_name','$product_price','$product_quantity','$product_author','$firstname','$lastname','$country','$street_address','$city','$postcode','$phone','$email','$payment_method', '$subtotal', '$vat', '$grand_total', '$date')";
  $result_insert = mysqli_query($connect, $query_insert);
  if ($result_insert) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function deleteOrder($connect, $id)
{
  $result = "";
  $query_delete = "DELETE FROM order_info WHERE id = '$id'";
  $result_delete = mysqli_query($connect, $query_delete);
  if ($result_delete) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function clearCart($connect, $author)
{
  $result = "";
  $query_clear = "DELETE FROM cart WHERE author = '$author'";
  $result_clear = mysqli_query($connect, $query_clear);
  if ($result_clear) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function emptyComment($rate, $comment, $name, $email)
{
  $result = "";
  if (empty($rate) or empty($comment) or empty($name) or empty($email)) {
    $result = false;
  } else {
    $result = true;
  }
  return $result;
}

function allPendingCommentByProduct($connect, $product_id)
{
  $result = "";
  $query_select = "SELECT * FROM pending_comment WHERE product_id = '$product_id'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $result = $result_select;
  } else {
    $result = false;
  }
  return $result;
}

function addPendingComment($connect, $product_id, $rate, $comment, $name, $email)
{
  $result = "";
  $query_insert = "INSERT INTO pending_comment (product_id, rate, comment, name, email) VALUES ('$product_id', '$rate', '$comment', '$name', '$email')";
  $result_insert = mysqli_query($connect, $query_insert);
  if ($result_insert) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function allCommentByProductId($connect, $product_id)
{
  $result = "";
  $query_select = "SELECT * FROM comment WHERE product_id = '$product_id'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $result = $result_select;
  } else {
    $result = false;
  }
  return $result;
}
