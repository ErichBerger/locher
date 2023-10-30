<?php 

    $currentTab = 'home';
    require 'views/index.views.php';

    $page = new Template();
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
    $page->start("cool title"); 

    //Add other views from other view classes here
    
    $page->end();
    ?>
</html>