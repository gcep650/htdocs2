<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.6
 * Module name: OrdersService Class
 * Module version: 1.2
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a class that contains functions related to order handling
 */

//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);
require_once("../Database/Autoloader.php");

class OrdersService {
    private $conn;
    
    public function __construct() {
        $db = new DBConnection();
        $this->conn = $db->getCon();
    }
    
    // creates a new order given a user id and address id
    public function createOrder($user_id, $address_id) {
        $cart = new ShoppingCart($user_id);
        
        $query = "INSERT INTO orders (DATE,USER_ID,ADDRESS_ID) VALUES (NOW(),?,?)";
        $run = $this->conn->prepare($query);
        $run->bind_param('ii', $cart->getUser_id(),$address_id);
        $run->execute();
        
        if ($run->affected_rows > 0) {
            $query = "SELECT ORDER_ID FROM orders WHERE ORDER_ID=LAST_INSERT_ID()";
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
                
                $coupon_id = $cart->getCoupon_id();
                
                if (!is_null($coupon_id)) {
                    $cs = new CouponsService();
                    $cs->addCouponToOrder($order_id, $cart->getCoupon_id());
                    
                    $query = "INSERT INTO coupons_used (USER_ID,COUPON_ID) VALUES (?,?)";
                    $run = $this->conn->prepare($query);
                    $run->bind_param('ii', $user_id, $coupon_id);
                    $run->execute();
                }
                
                $order->updateValues();
                
                $cart->destroy();
                return $order;
            }
        }
        
    }
    
    public function getOrdersByDate($startDate,$endDate) {
        $query = "SELECT * FROM orders WHERE DATE >= ? AND DATE <= ?";
        $run = $this->conn->prepare($query);
        $run->bind_param('ss', $startDate,$endDate);
        $run->execute();
        $result = $run->get_result();
        if ($result->num_rows > 0) {
            $orders = array();
            while ($row = $result->fetch_assoc()) {
                $o = new Order($row['ORDER_ID']);
                array_push($orders, $o);
            }
            return $orders;
        }
        else {
            throw new Exception("No orders were returned.");
        }
    }
}