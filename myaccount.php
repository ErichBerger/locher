<?php 
    require('model/database.php'); 
    require('functions.php');
    
    $db = new Database();
    $currentTab = 'My Account';

    
    require('views/partials/head.php');
    require('views/partials/nav.php');
    //logic for determining whether or not the my account view should appear. If not, they'll need to 
    //login
    isset($_POST['login']) || !isset($_POST['register']) ? require('views/login.views.php') : "";
    

    isset($_POST['register']) ? require('views/register.views.php') : "";

    require('views/partials/foot.php');

?>