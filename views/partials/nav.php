<header>
    <nav>
        <ul>
            <li <?php echo $currentTab === 'Home' ? 'id="current-tab"' : "";?>><a href="index.php" >LOCHER</a></li>
            
            
            <li <?php echo $currentTab === 'My Account' ? 'id="current-tab"' : "";?>><a href="myaccount.php" >My Account</a></li>
            <li <?php echo $currentTab === 'Menu' ? 'id="current-tab"' : "";?>><a href="menu.php">Menu</a></li>
            <li <?php echo $currentTab === 'Cart' ? 'id="current-tab"' : "";?>><a href="cart.php" >Cart</a></li>
        </ul>
    </nav>
</header>
<main>