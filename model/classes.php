<?php 

class MenuItem {
    private $id;
    private $name;
    private $price;
    private $imageFile;
    private $description;

    function __construct($id, $name, $price, $imageFile, $description) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->imageFile = $imageFile;
        $this->description = $description;
    }

    function getName() {
        return $this->name;
    }

    function getPrice() {
        return $this->price;
    }

    function getImageFile() {
        return $this->imageFile;
    }

    function getDescription() {
        return $this->description;
    }

    function getID() {
        return $this->id;
    }

}

class CustomerOrder {
    private $order_id;
    private $time_placed;
    private $time_completed;
    private $user_id;
    private $order_type;
    private $order_items;

    function __construct($order_id, $user_id, $order_items) {
        $this->order_id = $order_id;
        $this->user_id = $user_id;
        $this->order_items = $order_items;
    }

    function setUserID($user_id) {
        $this->user_id = $user_id;
    }

    function getUserID() {
        return $this->user_id;
    }

    function getOrderID() {
        return $this->order_id;
    }
    function add_order_item($order_item) {

    }

    function getOrderItems() {
        return $this->order_items;
    }
}

class OrderItem {
    private $menu_item;
    private $order_id;
    private $quantity;

    function __construct($menu_item, $order_id, $quantity) {
        $this->menu_item = $menu_item;
        $this->order_id = $order_id;
        $this->quantity = $quantity;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getOrderID() {
        return $this->order_id;
    }

    function getMenuItem() {
        return $this->menu_item;
    }
}


?>