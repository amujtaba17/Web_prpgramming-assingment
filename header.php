<?php
$user = isset($_SESSION['_user']) ? $_SESSION['_user'] : null;
if (isset($user)) {
    $login_menu_item = "Welcome " . $user["user_full_name"] . ' (<a href="logout.php">Logout</a>)';
}
?>


<style>



/* CSS code */
.header-menu {
  background-color:blue;
  height:max-content;
  text-align: center;
}

.header-menu a {
  color: white;
  text-decoration: none;
  padding: 10px 20px;
  margin: 0 10px;
  display: inline-block;
  font-weight: bold;
}

.header-menu a:hover {
  background-color: #555;
}





</style>



<header>
    <ul class="header-menu">
        <li><a href="home.php" class="menu-item">BLOGGER - Dummy Blog Website</a></li>
        
        <?php if (isset($login_menu_item)) : ?>
            <li><a href="addblog.php" class="menu-item">Wanna post something?</a></li>
            <li class="login-menu-item"><?= $login_menu_item ?></li>
        <?php endif; ?>
    </ul>
</header>