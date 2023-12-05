
    <table>
        <tr>
            <th>Name </th>
            <th>Price </th>
            <th class="small">Quantity </th>
            <th>Total</th>
        </tr>
        
        <?php foreach ($order->getOrderItems() as $item) : ?>
        <tr>
            <th><?= $item->getMenuItem()->getName()?></th>
            <td>$<?php echo (sprintf("%.2f", $item->getMenuItem()->getPrice())); ?></td>
            
            <td><form name="order_item" action="cart.php" method="post">
                <button type="submit" name="delete" value="<?= $item->getMenuItem()->getID() ?>">x</button>
                <input type="text" name="quantity" value="<?= $item->getQuantity()?>" size="2">
                <button type="submit" name="update" value="<?= $item->getMenuItem()->getID() ?>">Update</button>
            </form></td>
            <td>$<?php echo (sprintf("%.2f", $item->getMenuItem()->getPrice() * $item->getQuantity())); ?></td>
        </tr>
        
        <?php endforeach; ?>

    </table>

