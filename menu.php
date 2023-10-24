<?php 
    include 'includes/view-autoloader.inc.php';
    $page = new Template();
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
    $page->start("Menu"); 

    //Add other views from other view classes here
    
    $page->end();
    ?>
</html>