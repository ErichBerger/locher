<?php require('partials/head.php');?>
    
    <header>
        <?php require('partials/nav.php')?>
    </header>
    <main>
    <p>Note: Based on logic tbd, this page will either require the login view, or the account view</p>

    <?php require('forms/login.php'); ?>

    <form action="myaccount.php" method="post">
        <input type="submit" value="Click here to register" name="register">
    </form>
        
    </main>
<?php require('partials/foot.php'); ?>