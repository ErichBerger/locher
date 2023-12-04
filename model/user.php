<?php

class User {

private $user_id;
private $status;

function __construct() {
    if ( isset($_SESSION['user_id'])) {
        $this->user_id = $_SESSION['user_id'];
    }
}

function isLoggedIn() {
    return $this->user_id != null;
}

function getUserId() {
    return $this->user_id;
}

//Attempts to log in using supplied username and password, sets user_id in session for use in other tables if success
function logIn($username, $password) {
    $db = Database::instance();
    //if it's logged in, set session data
    $user_id = $db->logIn($username, $password);
    if ($user_id) {
        $_SESSION['user_id'] = $user_id;
        $this->user_id = $user_id;
        return true;
    }
    return false;
}

function addUser($username, $password, $fname, $lname, $phone, $address, $email) {
    $db = Database::instance();
    $result = $db->addUser($username, $password, $fname, $lname, $phone, $address, $email);
    
    switch ($result) {
        case Database::ERROR_USERNAME_EXISTS: 
            echo "Username already exists";
            unset($_POST['username']);
            unset($_POST['password']);
            break;
        case Database::ERROR_USER_NOT_ADDED:
            echo "User could not be added";
            unset($_POST['username']);
            unset($_POST['password']);
            break;
        case Database::SUCCESS:
            echo "User added. Attempting login...";
            $this->logIn($username, $password);
            return true;
            break;
    }
}

function logOut() {
    unset($_SESSION['user_id']);
}

}