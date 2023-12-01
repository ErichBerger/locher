<?php 
require ('model/queries.php');
require('model/classes.php');
class Database {
    //How about making one function that accepts an array for parameterizing, and returns results in an array?
    private static $db = null;


    private function __construct() {
        $this->db = new mysqli('localhost', 'ics325fa2302', '2224', 'ics325fa2302');
        if(mysqli_connect_errno()) {
            echo '<p>Error connecting to database, please try again.</p>'; 
            exit;
        }
    }

    public static function instance() {
        if (self::$db == null) {
            self::$db = new Database();
        }

        return self::$db;
    }

   

    function getMenuItems() {
       
        $itemArray = array();
        
        $stmt = $this->db->prepare("SELECT * FROM menu_item ");
        $stmt->execute();
        $stmt->store_result();
        
        $stmt->bind_result($id, $name, $price, $imageFile, $description);
        
        while ($stmt->fetch()) {
            
            $itemArray[] = new MenuItem($id, $name, $price, $imageFile, $description);
        }
        return $itemArray;
    }

    //User Functions

    function logIn($username, $password) {


        return false;
    }

    function getMenuItem($itemID) {
        
        $id = (int) $itemID;
        
        $name = null;
        $price = 0;
        $imageFile = null;
        $description = null;
        
        $stmt = $this->db->prepare("SELECT * FROM menu_item WHERE menu_item_id= ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
        
        $stmt->bind_result($id, $name, $price, $imageFile, $description);
        $stmt->fetch();
        return new MenuItem((int) $id, $name, $price, $imageFile, $description);

    }

    function newOrder($user_id) {
        $id = (int) $user_id;
        $stmt = $this->db->prepare("INSERT INTO customer_order(user_id) VALUES(?)");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if($stmt->affected_rows > 0) {
        }

    }
    function getOpenOrder($user_id) {
        $order = null;
        /*$order_id = 0;
        $time_placed = null;
        $time_completed = null;
        $order_type = null;
        $menu_item_id = 0;
        $quantity = 0;
        */
        $order_items = array();
        

        $stmt = $this->db->prepare("SELECT * FROM customer_order WHERE user_id = ? AND time_completed IS NULL");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($order_id, $time_placed, $time_completed, $user_id, $order_type);
        $stmt->fetch();
    
        if ($stmt->affected_rows > 0) {
            $order_id = (int) $order_id; //Not sure if necessary, just using to make sure.
            $user_id = (int) $user_id;
            //Retrieve items on that order
            $stmt = $this->db->prepare("SELECT menu_item_id, quantity FROM order_item WHERE order_id = ?");
            $stmt->bind_param('i', $order_id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($menu_item_id, $quantity);

            while ($stmt->fetch()) {
                $order_items[] = new OrderItem($this->getMenuItem((int) $menu_item_id), $order_id, (int) $quantity);
            }
            $order = new CustomerOrder($order_id, $user_id, $order_items);
        }

        return $order;
    }

    function addItemToOrder($order_id, $menu_item_id, $quantity) {
        /*
        $stmt = $this->db->prepare("INSERT INTO order_item VALUES(?, ?, ?)");
            $stmt->bind_param('iii', $order_id, $menu_item_id, $quantity);
            $stmt->execute();
            
            if($stmt->affected_rows > 0) {
                echo "Item added to order.";
            }
        */
       
        $stmt = $this->db->prepare("SELECT order_id FROM order_item WHERE order_id = ? AND menu_item_id = ?");
        $stmt->bind_param('ii', $order_id, $menu_item_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($test);
        $stmt->fetch();

        if ($stmt->num_rows == 0) {
            $stmt = $this->db->prepare("INSERT INTO order_item VALUES(?, ?, ?)");
            $stmt->bind_param('iii', $order_id, $menu_item_id, $quantity);
            $stmt->execute();
            
            if($stmt->affected_rows > 0) {
                echo "Item added to order.";
            }
        }

        else {
            $stmt = $this->db->prepare("SELECT quantity FROM order_item WHERE order_id = ? AND menu_item_id = ?");
            $stmt->bind_param('ii', $order_id, $menu_item_id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($old_quantity);
            $stmt->fetch();
            $quantity += $old_quantity;

            $stmt = $this->db->prepare("UPDATE order_item SET quantity=? WHERE order_id = ? AND menu_item_id = ?");
            $stmt->bind_param('iii', $quantity, $order_id, $menu_item_id);
            $stmt->execute();
            echo "Successfully updated quantity.";
        }
    }
}

?>