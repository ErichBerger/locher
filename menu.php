
<?php
    require('model/database.php'); 
    require('functions.php');

    $db = Database::instance();
    $currentTab = 'Menu';
    $user_id = 1; //just a placeholder for when we do login stuff
    
    //If existing order has been created, add the menu item to the order, update database.
    //If order has not been created, create new order, add item to order, update database.

    require('views/partials/head.php');
    require('views/partials/nav.php');
    if (isset($_POST['added_item']) && isset($_POST['quantity'])) {
        $order = $db->getOpenOrder($user_id);
        $added_item = $db->getMenuItem($_POST['added_item']);
        //Works up to here
        if ($order == NULL) {
            $db->newOrder($user_id);
            
            $order = $db->getOpenOrder($user_id);
            echo "If null, the getOpenOrder function is not working: ";
            var_dump($order);
            
        }

        $db->addItemToOrder($order->getOrderID(), $added_item->getID(), (int) $_POST['quantity']);
    }
    $itemArray = $db->getMenuItems();
    
    require ('views/menu.views.php');

    require('views/partials/foot.php');
?>