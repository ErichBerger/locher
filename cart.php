
<?php
   session_start();
   require('model/database.php');
   require('model/user.php');
   
   $db = Database::instance();
   $currentTab = 'Cart';
   $user = new User();
   $order = null;
   require('views/partials/head.php');
   require('views/partials/nav.php');
   if (isset($_SESSION['order_id'])) {
      if(isset($_POST['update']) && isset($_POST['quantity'])) {
         $db->addItemToOrder($_SESSION['order_id'], $_POST['update'], $_POST['quantity']);
      }
      if(isset($_POST['delete'])) {
         $db->deleteItemOnOrder( $_SESSION['order_id'], $_POST['delete']);
      }
      $order = $db->getOrder($_SESSION['order_id']);
      require ('views/cart.views.php');
   }
   else {
      echo 'An order has not been generated. Please visit the <a href="menu.php">menu</a> to start one.';
   }
   if(!$user->isLoggedIn()) {
      echo "Please login before placing the order. Any progress will be saved.";
   }
   else {
      require('views/forms/checkout.php');
   }
   
   require('views/partials/foot.php');

?>