<?php 
    $items = "SELECT * FROM menu_item WHERE menu_item_id = ? ";

    $pastOrders = "SELECT
    order_id,
    time_placed,
    time_completed,
    fname,
    lname,
    name,
    quantity,
FROM
    customer_order
JOIN
    customer ON user_id = user_id
JOIN 
    orderItem ON order_id = order_id
JOIN
    menuItem ON menuItem_id = menuItem_id
WHERE
    user_id = user_id AND open = false;
ORDER BY
    time_completed DESC";

$orderItems = "SELECT 
order_id,
name,
price,
quantity,
FROM
order_item
JOIN 
menu_item ON menu_item_id = menu_item_id
WHERE
user_id = (customer_id) AND time_completed IS NOT NULL";

?>