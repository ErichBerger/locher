
    <table>
        <tr>
            <th>Name </th>
            <th>Price </th>
            <th>Quantity </th>
        </tr>
        <?php foreach ($order->getOrderItems() as $item) : ?>
        <tr>
            <th><?= $item->getMenuItem()->getName()?></th>
            <td><?= $item->getMenuItem()->getPrice()?></td>
            <td><?= $item->getQuantity()?></td>
        </tr>
        <?php endforeach; ?>

    </table>
    <?php require('forms/checkout.php'); ?>
