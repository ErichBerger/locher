
<?php
    session_start();
    require('model/database.php'); //database has classes required.
    require('model/user.php');
    

    $db = Database::instance();
    $currentTab = 'Menu';
    $user = new User();

    require('views/partials/head.php');
    require('views/partials/nav.php');
    $order = null;
    $order_id;
    if (isset($_SESSION['order_id'])) {                                     //Check to see if an order has been started
                                                
        $order = $db->getOrder($_SESSION['order_id']);                      

        if ($order->getUserID() == 0) {                                  //Check if order has customer attached

            if (isset($_SESSION['user_id'])) {                              //Check to see if user is logged in
                $db->updateOrderUserID($_SESSION['order_id'], $_SESSION['user_id']);
                $order->setUserID($_SESSION['user_id']);
            }
            
            else {                                                          //If not, display message
                echo "Look's like you're not logged in. Click <a href='login.php'>here</a> to make sure you're order is saved.";
            }
        }                                                                   //No else really needed for this loop, it means the order is attached to a user
    }

    else {                                                                  //If order has not been created, we also need to check for a few things
        if(isset($_SESSION['user_id'])) {                                   //If user is logged in, check if they have an open order
            $order_id = $db->getOpenOrder($_SESSION['user_id']);            //Database checks if user has one, creates if not with user id
        }
        else {
            $order_id = $db->newOrder();
        }
        $_SESSION['order_id'] = $order_id;
        
    }

    //Actual updating of items
    if (isset($_POST['added_item']) && isset($_POST['quantity'])) {
        $added_item = $db->getMenuItem($_POST['added_item']);
        //Works up to here
        if ($order == NULL) {
            
            echo "If null, an order was not generated: ";
            var_dump($order);
            
        }
        $db->addItemToOrder($order->getOrderID(), $added_item->getID(), (int) $_POST['quantity']);
    }

    //If anything has changed by updating, repopulate the order
    $order = $db->getOrder($_SESSION['order_id']);
    $itemArray = $db->getMenuItems();
    $orderItems = $order->getOrderItems();

    foreach ($itemArray as $item) {
        $item->setQuantity(0);
        foreach ($orderItems as $orderItem) { //Will override 0 quantity.
            if ($item->getID() == $orderItem->getMenuItem()->getID()) {
                $item->setQuantity($orderItem->getQuantity());
            }
        }
    }
    require ('views/menu.views.php');

    require('views/partials/foot.php');
?>