<?php
require_once("../Database/Autoloader.php");

class OrdersService {
    private $conn;
    
    public function __construct() {
        $db = new DBConnection();
        $this->conn = $db->getCon();
    }
    
    public function createOrder($cart_id, $address_id) {
        $cart = new ShoppingCart($cart_id);
        
        $query = "INSERT INTO orders (DATE,USER_ID,ADDRESS_ID) VALUES (NOW(),?,?)";
        $run = $this->conn->prepare($query);
        $run->bind_param('ii', $cart->getUser_id(),$address_id);
        $run->execute();
        
        if ($run->affected_rows > 0) {
            $query = "SELECT * FROM orders WHERE ORDER_ID=LAST_INSERT_ID()";
            $run = $this->conn->prepare($query);
            $run->execute();
            
            $result = $run->get_result();
            
            if ($result->num_rows > 0) {
                $info = $result->fetch_assoc();
                $order_id = $info['ORDER_ID'];
                $order = new Order($order_id);
                
                foreach ($cart->getItems() as $item) {
                    $order->addItem($item->getProductId(), $item->getQuantity());
                }
                $cart->destroy();
                return $order;
            }
        }
        
    }
}