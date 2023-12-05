<?php

class User {

private $user_id;
private $status;
private $fname;
private $lname;
private $phone;
private $address;
private $email;

function __construct() {
    if ( isset($_SESSION['user_id'])) {
        $this->user_id = $_SESSION['user_id'];
        //$this->loadUser();
    }
}
/*
function loadUser() {
    $db = Database::instance();
    $results = $db->loadUser($this->user_id);
    
    $this->fname = $results['fname'];
    $this->lname = $results['lname'];
    $this->phone = $results['phone'];
    $this->address = $results['address'];
    $this->email = $results['email'];
}
*/
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
        //$this->loadUser();
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
    unset($_SESSION['order_id']);
    session_destroy();
}


function getFName() {
    return $this->fname;
}
function getLName() {
    return $this->lname;
}
function getPhone() {
    return $this->phone;
}
function getEmail() {
    return $this->email;
}
function getAddress() {
    return $this->address;
}


}