<?php 
    session_start();
    require('model/database.php');
    require('model/user.php');
    
    $db = Database::instance();
    
    $user = new User();
    $currentTab = 'My Account';
    require('views/partials/head.php');
    require('views/partials/nav.php');
    
    //send functionality to other page
    if (isset($_POST['logOut'])) {
        $user->logOut();
    }
    
    if ($user->isLoggedIn()) {
        require('views/myaccount.views.php');
    }
    
    else {
        require('views/myaccountalt.views.php');
    }
    
    require('views/partials/foot.php');

?>