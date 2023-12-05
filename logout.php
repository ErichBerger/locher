<?php
session_start();
    require('model/database.php');
    require('model/user.php');

    $db = Database::instance();
    $user = new User();
    $currentTab = 'My Account';
    require('views/partials/head.php');
    require('views/partials/nav.php');

    if ($user->isLoggedIn()) {
        if (isset($_POST['logOut'])) {
            $user->logOut();
        }
    }
    else {
        echo 'You are not logged in. Click <a href="login.php">here</a> to log in.';
    }

    require('views/partials/foot.php');

?>