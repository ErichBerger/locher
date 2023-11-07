<?php 

    $currentTab = 'My Account';

    //logic for determining whether or not the my account view should appear. If not, they'll need to 
    //login

    isset($_POST['login']) || !isset($_POST['register']) ? require('views/login.views.php') : "";
    

    isset($_POST['register']) ? require('views/register.views.php') : "";
    

?>