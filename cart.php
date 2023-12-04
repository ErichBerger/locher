
<?php
    
   require('model/database.php');
   require('model/user.php');
   
   $db = Database::instance();
   $currentTab = 'Cart';
   $user = new User();
   $order = $db->getOpenOrder($userID);
   require('views/partials/head.php');
   require('views/partials/nav.php');
   if (isset($_SESSION['order_id'])) {
      require ('views/cart.views.php');
   }
   else {
      echo 'An order has not been generated. Please visit the <a href="menu.php">menu</a> to start one.';
   }

   require('views/partials/foot.php');

?>