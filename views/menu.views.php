
<h3>List of Menu Items</h3>
<div class="item-list">
    <?php foreach ($itemArray as $item) : ?>

            <div class="item">
                <img src="resources/<?= $item->getImageFile()?>" width = "200px" height="200px">
                <p><?= $item->getName()?></p>
                <p><?= $item->getPrice()?></p>
                <form method="post">
                    <label for="<?= $item->getName()?> quantity">Quantity: </label>
                    <input type="text" name="quantity" id="<?= $item->getName()?> quantity" size="2" required placeholder="0">
                    <button name="added_item" value="<?= $item->getID()?>" type="submit" action="menu.php">Add</button>
                </form>
            </div>  
    <?php endforeach;?>
</div>
<p><a href="cart.php">Checkout</a></p>
  