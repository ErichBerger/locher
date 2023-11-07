<?php require('partials/head.php');?>
    
    <header>
        <?php require('partials/nav.php')?>
    </header>
    <main>
    <p>Note: Based on logic tbd, this page will either require the login view, or the account view</p>

    <?php require('forms/register.php'); ?></br>

    <form action="myaccount.php" method="post">
        <input type="submit" value="Go back to login" name="login">
    </form>
        
    </main>
<?php require('partials/foot.php'); ?>