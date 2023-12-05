<?php
    session_start();
    require('model/database.php');
    require('model/user.php');
    
    $db = Database::instance();
    $currentTab = 'Checkout';
    $user = new User();
    require('views/partials/head.php');
    require('views/partials/nav.php');
    if(!isset($_SESSION['user_id']) || !isset($_SESSION['order_id'])) {
        echo 'Please log in or start an order before checking out. Click <a href="menu.php">here</a> to go to the menu.';
    }
    else if(!isset($_POST['type'])) {
        echo 'Please select either pickup or delivery. <a href="cart.php">Go back</a>';
    }

    else {
        $tip = 0;
        $time = date("F j, Y, g:i a");
        if (isset($_POST['tipAmount'])) {
            $tip = $_POST['tipAmount'];
        }
        $order_id = $_SESSION['order_id'];

        $order = $db->getOrder($order_id);
        
        $total = $order->getTotal() + $tip;
        if ($db->placeOrder($order_id, $time)) {
            require ('views/checkout.views.php');
            unset($_SESSION['order_id']);
        }
        
    }
    
    require('views/partials/foot.php');
?>
