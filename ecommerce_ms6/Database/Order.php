<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.5
 * Module name: Order Class
 * Module version: 1.1
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a class that represents an Order object from the database.
 */

//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);

require_once("../Database/Autoloader.php");
class Order implements JsonSerializable {
    private $order_id;
    private $date;
    private $user_id;
    private $address_id;
    private $coupon_id;
    private $conn;
    
    // returns total price of the order
    public function getTotal() {
        $items = $this->getOrderDetails();
        $total = 0;
        foreach ($items as $item) {
            $total += $item->getCurrent_price() * $item->getQuantity();
        }
        
        $cs = new CouponsService();
        
        $total = $cs->applyCouponToTotal($total, $this->coupon_id);
        
        return $total;
    }
    
    // creates a new order object given the order id
    public function __construct($id) {
        $db = new DBConnection();
        $this->conn = $db->getCon();
        $this->order_id = $id;
        
        $this->updateValues();
    }
    
    // adds an item to the order
    public function addItem($product_id,$quantity) {
        $query = "INSERT INTO order_details (ORDER_ID,PRODUCT_ID,QUANTITY,CURRENT_PRICE) VALUES (?,?,?,?)";
        $run = $this->conn->prepare($query);
        $product = new Product($product_id);
        
        $run->bind_param('iiid', $this->order_id,$product_id,$quantity,$product->getPrice());
        $run->execute();
        
        return $run->affected_rows;
    }
    
    // updates member variables of current instance with values from database
    public function updateValues() {
        $query = "SELECT * FROM orders WHERE ORDER_ID=?";
        $run = $this->conn->prepare($query);
        $run->bind_param('i', $this->order_id);
        $run->execute();
        
        $result = $run->get_result();
        
        if ($result->num_rows > 0) {
            $info = $result->fetch_assoc();
            
            $this->date = $info['DATE'];
            $this->user_id = $info['USER_ID'];
            $this->address_id = $info['ADDRESS_ID'];
            $this->coupon_id = $info['COUPON_ID'];
        }
    }
    
    // returns array of OrderDetails objects (information about each product ordered)
    public function getOrderDetails() {
        $query = "SELECT * FROM order_details WHERE ORDER_ID=? ORDER BY QUANTITY DESC";
        $run = $this->conn->prepare($query);
        $run->bind_param('i', $this->order_id);
        $run->execute();
        $result = $run->get_result();
        
        $orderDetails = array();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($orderDetails,new OrderDetails($row['ORDER_DETAILS_ID']));
            }
        }
        
        return $orderDetails;
    }
    
    public function getAddress() {
        return new Address($this->address_id);
    }
    
    public function getCoupon() {
        if (!is_null($this->coupon_id)) {
            return new Coupon($this->coupon_id);
        }
    }
    
    /**
     * @return mixed
     */
    public function getOrder_id()
    {
        return $this->order_id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getAddress_id()
    {
        return $this->address_id;
    }
    
    /**
     * @return mixed
     */
    public function getCoupon_id()
    {
        return $this->coupon_id;
    }
    
    public function jsonSerialize()
    {
        $retval = get_object_vars($this);
        array_pop($retval);
        array_push($retval,$this->getOrderDetails());
        return $retval;
    }

}