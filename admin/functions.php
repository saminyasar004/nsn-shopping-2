<?php

/*
 * all functionality defined in this file for the admin panel
 * hashPassword funtion use for secure user password
 * emptyAddUser funtion use if user does not fill any field
 * usernameExist function use for if the given username is already taken
 * emailExist function use for if the given email is already taken
 * addUser funtion is use to add a new user account in our database
 * emptyLogin function use if login form field is empty
 * userLogin function use for login user correctly
 * autoLogout function use for logout automatically after a certain times
 * allData function use for fetch all data from given table
 * allDataPagination use for paginaiton
 * emptyUpdateUser function use to see if the edit user data fields are empty
 * updateUser function is use to update user data
 * deleteUser function use to delete an user
 * selectAllCategory function use to select all category from database
 * categoryNameById function use to see the category name by category id
 * emptyCategory function use to see if the category form is empty
 * addCategory function use to add a new category
 * updateCategory function use to update category data
 * deleteCategory function use to delete a category
 * selectCategoryProduct function use to see the product number of the given category
 * emptyAddProduct function use to see if the add product fields are empty
 * productNameExist function use to see the given product name is alredy exist
 * addProduct function use to add a new product
 * allProductForModerator function use to fetch all data for moderator
 * updateProduct function use to update a product details
 * deleteProduct function use to delete a product
 * increaseCategoryProduct function use to increase category poduct number
 * decreaseCategoryProduct function use to decrease category product number
 * switchCategory function use to switch category product
 * completeOrder function use to remove an order from order database
 * removePendingComment function use to remove comment from pending comment for approve
 * allPendingCommentById function use to see all information by id
 * approveComment functio use to approve a particualr comment
 * deleteComment function use to delete a particular comment
 */

function hashPassword($password)
{
  $result = base64_encode($password);
  return $result;
}

function emptyAddUser($fname, $lname, $username, $email, $password)
{
  $result = "";
  if (empty($fname) or empty($lname) or empty($username) or empty($email) or empty($password)) {
    $result = false;
  } else {
    $result = true;
  }
  return $result;
}

function usernameExist($connect, $username)
{
  $result = "";
  $query_select = "SELECT * FROM user WHERE username = '$username'";
  $result_select = mysqli_query($connect, $query_select);
  $count = mysqli_num_rows($result_select);
  if ($count > 0) {
    $result = false;
  } else {
    $result = true;
  }
  return $result;
}

function emailExist($connect, $email)
{
  $result = "";
  $query_select = "SELECT * FROM user WHERE email = '$email'";
  $result_select = mysqli_query($connect, $query_select);
  $count = mysqli_num_rows($result_select);
  if ($count > 0) {
    $result = false;
  } else {
    $result = true;
  }
  return $result;
}

function addUser($connect, $first_name, $last_name, $username, $email, $password, $role)
{
  $result = "";
  $query_insert = "INSERT INTO user (first_name, last_name, username, email, password, role) VALUES ('$first_name', '$last_name', '$username', '$email', '$password', '$role')";
  $result_insert = mysqli_query($connect, $query_insert);
  if ($result_insert) {
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

function userLogin($connect, $username, $password)
{
  $result = "";
  $query_select = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
  $result_select = mysqli_query($connect, $query_select);
  $count = mysqli_num_rows($result_select);
  if ($count > 0) {
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

function allDataWithElement($connect, $db_table, $db_element, $db_value)
{
  $result = "";
  $query_select = "SELECT * FROM $db_table WHERE $db_element = '$db_value'";
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

function emptyUpdateUser($fname, $lname, $username, $email)
{
  $result = "";
  if (empty($fname) or empty($lname) or empty($username) or empty($email)) {
    $result = false;
  } else {
    $result = true;
  }
  return $result;
}

function updateUser($connect, $edit_id, $fname, $lname, $username, $email, $role)
{
  $result = "";
  $query_update = "UPDATE user SET first_name = '$fname', last_name = '$lname', username = '$username', email = '$email', role = '$role' WHERE user.user_id = '$edit_id'";
  $result_update = mysqli_query($connect, $query_update);
  if ($result_update) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function deleteUser($connect, $delete_id)
{
  $result = "";
  $query_delete = "DELETE FROM user WHERE user_id = '$delete_id'";
  $result_delete = mysqli_query($connect, $query_delete);
  if ($result_delete) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function selectAllCategory($connect)
{
  $result = "";
  $query_select = "SELECT * FROM category";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $result = $result_select;
  } else {
    $result = false;
  }
  return $result;
}

function categoryNameById($connect, $category_id)
{
  $result = "";
  $query_select = "SELECT category_name FROM category WHERE category_id = '$category_id'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $result = $result_select;
  } else {
    $result = false;
  }
  return $result;
}

function emptyCategory($category)
{
  $result = "";
  if (empty($category)) {
    $result = false;
  } else {
    $result = true;
  }
  return $result;
}

function addCategory($connect, $category_name)
{
  $result = "";
  $query_insert = "INSERT INTO category (category_name, product) VALUES ('$category_name', '0')";
  $result_insert = mysqli_query($connect, $query_insert);
  if ($result_insert) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function updateCategory($connect, $edit_id, $category_name)
{
  $result = "";
  $query_update = "UPDATE category SET category_name = '$category_name' WHERE category.category_id = '$edit_id'";
  $result_update = mysqli_query($connect, $query_update);
  if ($result_update) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function deleteCategory($connect, $delete_id)
{
  $result = "";
  $query_delete =  "DELETE FROM category WHERE category_id = '$delete_id'";
  $result_delete = mysqli_query($connect, $query_delete);
  if ($result_delete) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function selectCategoryProduct($connect, $category_id)
{
  $result = "";
  $query_select = "SELECT product FROM category WHERE category_id = '$category_id'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $result = $result_select;
  } else {
    $result = false;
  }
  return $result;
}

function emptyAddProduct($name, $price, $desc, $category, $date, $author, $image_name)
{
  $result = "";
  if (empty($name) or empty($price) or empty($desc) or empty($category) or empty($date) or empty($author) or empty($image_name)) {
    $result = false;
  } else {
    $result = true;
  }
  return $result;
}

function productNameExist($connect, $name)
{
  $result = "";
  $query_select = "SELECT * FROM product_info WHERE name = '$name'";
  $result_select = mysqli_query($connect, $query_select);
  $count_product = mysqli_num_rows($result_select);
  if ($count_product > 0) {
    $result = false;
  } else {
    $result = true;
  }
  return $result;
}

function addProduct($connect, $name, $price, $desc, $category, $date, $author, $img)
{
  $result = "";
  $query_insert = "INSERT INTO product_info (name, price, description, category, date, author, img) VALUES ('$name', '$price', '$desc', '$category', '$date', '$author', '$img')";
  $result_insert = mysqli_query($connect, $query_insert);
  if ($result_insert) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function allProductForModerator($connect)
{
  $result = "";
  $query_select = "SELECT * FROM product_info WHERE author = 'Moderator'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function updateProduct($connect, $edit_id, $name, $price, $desc, $category, $img)
{
  $result = "";
  $query_update = "UPDATE product_info SET name = '$name', price = '$price', description = '$desc', category = '$category', img = '$img' WHERE product_info.id = '$edit_id'";
  $result_update = mysqli_query($connect, $query_update);
  if ($result_update) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function deleteProduct($connect, $delete_id)
{
  $result = "";
  $query_delete = "DELETE FROM product_info WHERE id = '$delete_id'";
  $result_delete = mysqli_query($connect, $query_delete);
  if ($result_delete) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function increaseCategoryProduct($connect, $category_id)
{
  $result = "";
  $query_increase = "UPDATE category SET product = product + 1 WHERE category_id = '$category_id'";
  $result_increase = mysqli_query($connect, $query_increase);
  if ($result_increase) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function decreaseCategoryProduct($connect, $category_id)
{
  $result = "";
  $query_decrease = "UPDATE category SET product = product - 1 WHERE category_id = '$category_id'";
  $result_decrease = mysqli_query($connect, $query_decrease);
  if ($result_decrease) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}


function switchCategory($connect, $increaseId, $decreaseId)
{
  $result = "";
  $query_increase = "UPDATE category SET product = product + 1 WHERE category_id = '$increaseId'";
  $query_decrease = "UPDATE category SET product = product - 1 WHERE category_id = '$decreaseId'";
  $result_increase = mysqli_query($connect, $query_increase);
  $result_decrease = mysqli_query($connect, $query_decrease);
  if ($result_increase && $result_decrease) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function completeOrder($connect, $order_id)
{
  $result = "";
  $query_delete = "DELETE FROM order_info WHERE id = '$order_id'";
  $result_delete = mysqli_query($connect, $query_delete);
  if ($result_delete) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function removePendingComment($connect, $id)
{
  $result = "";
  $query_delete = "DELETE FROM pending_comment WHERE id = '$id'";
  $result_delete = mysqli_query($connect, $query_delete);
  if ($result_delete) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function allPendingCommentById($connect, $id)
{
  $result = "";
  $query_select = "SELECT * FROM pending_comment WHERE id = '$id'";
  $result_select = mysqli_query($connect, $query_select);
  if ($result_select) {
    $result = $result_select;
  } else {
    $result = false;
  }
  return $result;
}

function approveComment($connect, $product_id, $rate, $comment, $name, $email)
{
  $result = "";
  $query_insert = "INSERT INTO comment (product_id, rate, comment, name, email) VALUES ('$product_id', '$rate', '$comment', '$name', '$email')";
  $result_insert = mysqli_query($connect, $query_insert);
  if ($result_insert) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function deleteComment($connect, $id)
{
  $result = "";
  $query_delete = "DELETE FROM pending_comment WHERE id = '$id'";
  $result_delete = mysqli_query($connect, $query_delete);
  if ($result_delete) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}
