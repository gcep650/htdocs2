<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.5
 * Module name: OrderDetails Class
 * Module version: 1.1
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a class that represents the details of a product in an order
 */
require_once("../Database/Autoloader.php");
class OrderDetails implements JsonSerializable {
    private $order_details_id;
    private $order_id;
    private $product_id;
    private $quantity;
    private $current_price;
    
    // create OrderDetails object given order_details_id
    public function __construct($id) {
        $db = new DBConnection();
        $this->conn = $db->getCon();
        $this->order_details_id = $id;
        
        $this->updateValues();
    }
    
    // updates member variables of current instance with values from database
    public function updateValues() {
        $query = "SELECT * FROM order_details WHERE ORDER_DETAILS_ID=?";
        $run = $this->conn->prepare($query);
        $run->bind_param('i', $this->order_details_id);
        $run->execute();
        
        $result = $run->get_result();
        
        if ($result->num_rows > 0) {
            $info = $result->fetch_assoc();
            
            $this->order_id = $info['ORDER_ID'];
            $this->product_id = $info['PRODUCT_ID'];
            $this->quantity = $info['QUANTITY'];
            $this->current_price = $info['CURRENT_PRICE'];
        }
    }
    
    // returns the product in the order as a Product object
    public function getProduct() {
        return new Product($this->product_id);
    }
    
    // returns the parent order that the OrderDetails is from
    public function getOrder() {
        return new Order($this->order_id);
    }
    /**
     * @return mixed
     */
    public function getOrder_details_id()
    {
        return $this->order_details_id;
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
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getCurrent_price()
    {
        return $this->current_price;
    }
    
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        array_pop($vars);
        array_push($vars,$this->getProduct());
        return $vars;
    }

}