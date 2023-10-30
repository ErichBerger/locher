<nav>
    <a href="index" <?php echo $currentTab === 'home' ? 'class="current-tab"' : "";?>>Home</a>
    <a href="menu" <?php echo $currentTab === 'menu' ? 'class="current-tab"' : "";?>>Menu</a>
    <a href="checkout" <?php echo $currentTab === 'checkout' ? 'class="current-tab"' : "";?>>Checkout</a>
    <a href="myaccount" <?php echo $currentTab === 'myaccount' ? 'class="current-tab"' : "";?>>My Account</a>
</nav>