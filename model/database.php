<?php 
require ('model/queries.php');
require('model/classes.php');
class Database {
    //How about making one function that accepts an array for parameterizing, and returns results in an array?
    private static $db = null;
    public const ERROR_USERNAME_EXISTS = 2;
    public const ERROR_USER_NOT_ADDED = 3;
    public const SUCCESS = 1;


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

   

    

    //User Functions

    function logIn($username, $password) {
        
        $password =  hash('sha256', $password);
        
        $stmt = $this->db->prepare("SELECT user_id FROM customer WHERE username= ? AND password = ?");
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($userID);
        $stmt->fetch();
        if ($stmt->affected_rows > 0) {
            return $userID;
        }

        return False;
    }

    function checkUsername($username) {
        $stmt = $this->db->prepare("SELECT count(*) FROM customer WHERE username=?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($num);
        $stmt->fetch();

        if ($num > 0) {
            return true;
        }

        return false;
    }

    function addUser($username, $password, $fname, $lname, $phone, $address, $email) {
        
        if ($this->checkUsername($username)) {
            return Database::ERROR_USERNAME_EXISTS;
        }
        
        else {
            
            $password = hash('sha256', $password);
            $stmt = $this->db->prepare("INSERT INTO customer(username, password, fname, lname, phone, address, email) VALUES (?,?,?,?,?,?,?)");
           
            $stmt->bind_param('sssssss', $username, $password, $fname, $lname, $phone, $address, $email);
            $stmt->execute();
            
            $stmt->store_result();
            $stmt->bind_result($result);
            if($stmt->affected_rows > 0) {
                return Database::SUCCESS;
            }
        }
        return Database::ERROR_USER_NOT_ADDED;
    }
    //For display
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

    //function for adding a new order with a user or not, works for both
    function newOrder($user_id = 0) {
        $id = (int) $user_id;
        $stmt = $this->db->prepare("INSERT INTO customer_order(user_id) VALUES(?)");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->affected_rows > 0) {
            return $stmt->insert_id;
        }
    }

    function getOrder($order_id) {
        $order_id = (int) $order_id;
        $order = null;
        $order_items = array();

        $stmt = $this->db->prepare("SELECT order_id, user_id FROM customer_order WHERE order_id = ?");
        $stmt->bind_param('i', $order_id);

        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($order_id, $user_id);
        $stmt->fetch();

        if ($stmt->affected_rows > 0) { //If an open order exists, return the order
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

    function updateOrderUserID($order_id, $user_id) {
        $order_id = (int) $order_id;
        $user_id = (int) $user_id;
        $stmt = $this->db->prepare("UPDATE customer_order SET user_id=? WHERE order_id = ?");
        $stmt->bind_param('ii', $user_id, $order_id);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->affected_rows > 0) {
            echo 'order updated with user id';
        }
    }
    //Function for when there is not an order, but a user is logged in
    //Returns order_Id when on hasn't been set by session.
    function getOpenOrder($user_id) {
        $order = null;
        
        $stmt = $this->db->prepare("SELECT order_id FROM customer_order WHERE user_id = ? AND time_completed IS NULL");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($order_id);
        $stmt->fetch();

        if ($stmt->affected_rows > 0) { //If an open order exists, return the order_id
            return $order_id;
        }

        else {
            $order_id = $this->newOrder($user_id);

            return $order_id;
        }
        
    }

    function addItemToOrder($order_id, $menu_item_id, $quantity) {
       
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