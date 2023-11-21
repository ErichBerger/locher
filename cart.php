
<?php
    
   $userID = 1;
   require('model/database.php'); 
   require('functions.php');
   
   $db = new Database();
   $currentTab = 'Cart';
   $order = $db->getOpenOrder($userID);
   require('views/partials/head.php');
   require('views/partials/nav.php');

   require ('views/checkout.views.php');

   require('views/partials/foot.php');

?>