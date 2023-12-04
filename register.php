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
        echo ('You are already logged on. Click <a href="myaccount.php">here</a> to view your account.');
    }
    else if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        var_dump($username);
        if($user->addUser($username, $password, $fname, $lname, $phone, $address, $email)) {
            echo 'You are logged in! click <a href="myaccount.php">here</a> to go to your account.';
        }
    }
    else {
        require('views/register.views.php');
    }

    require('views/partials/foot.php');


?>