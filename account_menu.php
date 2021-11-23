<?php
autoLogout();
if (!isset($_SESSION["customer_username"])) {
  header("location: account.php");
}
?>

<!-- account menu section start -->

<div class="accountMenu col1 span-2-of-6">
  <div class="menuHeader">
    <h3>my account</h3>
  </div>
  <div class="menuContainer">
    <ul>
      <li><a href="dashboard.php">dashboard</a></li>
      <li><a href="order.php">order</a></li>
      <li><a href="account_details.php">account details</a></li>
      <li><a href="logout.php">logout</a></li>
    </ul>
  </div>
</div>

<!-- account menu section end -->