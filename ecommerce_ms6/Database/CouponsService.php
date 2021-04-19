<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.6
 * Module name: Coupons Service Class
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module contains a class that provides a number of coupon-related functions
 */
require_once("../Database/Autoloader.php");
class CouponsService {
    private $conn;
    
    public function __construct() {
        $db = new DBConnection();
        $this->conn = $db->getCon();
    }
    
    // returns an array of Coupon objects
    public function getCoupons() {
        $query = "SELECT COUPON_ID FROM coupons";
        $run = $this->conn->prepare($query);
        $run->execute();
        $result = $run->get_result();
        
        $coupons = array();
        
        while ($row = $result->fetch_assoc()) {
            array_push($coupons,new Coupon($row['COUPON_ID']));
        }
        
        return $coupons;
    }
    
    // returns a Coupon object corresponding to the coupon code given
    public function getCouponFromCode($code) {
        $query = "SELECT * FROM coupons WHERE COUPON_CODE=?";
        $run = $this->conn->prepare($query);
        $run->bind_param('s', $code);
        $run->execute();
        
        $result = $run->get_result();
        
        if ($result->num_rows > 0) {
            $info = $result->fetch_assoc();
            return new Coupon($info['COUPON_ID']);
        }
        return NULL;
    }
    
    // checks if a coupon code exists in the database
    public function checkCouponExists($code) {
        $query = "SELECT * FROM coupons WHERE COUPON_CODE=?";
        $run = $this->conn->prepare($query);
        $run->bind_param('s', $code);
        $run->execute();
        
        return $run->get_result()->num_rows;
    }
    
    // checks if a user has used a specified coupon before
    public function checkCouponUsed($coupon_id, $user_id) {
        $query = "SELECT * FROM coupons_used WHERE COUPON_ID=? AND USER_ID=?";
        $run = $this->conn->prepare($query);
        $run->bind_param('ii', $coupon_id,$user_id);
        $run->execute();
        
        return $run->get_result()->num_rows > 0;
    }
    
    // creates a new coupon given a code and value
    // code -> coupon code (ex: 25OFF)
    // value -> discount value
    // if value < 1, coupon is represented as percentage off
    // if value > 1, coupon is represented as dollars off
    public function createCoupon($code, $value) {
        $query = "INSERT INTO coupons (COUPON_CODE,VALUE) VALUES (?,?)";
        $run = $this->conn->prepare($query);
        $run->bind_param('sd', $code, $value);
        $run->execute();
        
        return $run->affected_rows;
    }
    
    // updates a Order entry to add a coupon code
    public function addCouponToOrder($order_id, $coupon_id) {
        $query = "UPDATE orders SET COUPON_ID=? WHERE ORDER_ID=?";
        $run = $this->conn->prepare($query);
        $run->bind_param('ii', $coupon_id,$order_id);
        $run->execute();
        
        return $run->affected_rows;
    }
    
    // updates a ShoppingCart entry to add a coupon code
    public function addCouponToCart($cart_id, $coupon_id) {
        $query = "UPDATE shopping_carts SET COUPON_ID=? WHERE CART_ID=?";
        $run = $this->conn->prepare($query);
        $run->bind_param('ii', $coupon_id,$cart_id);
        $run->execute();
        
        //echo "hewiuohrew";
        //print_r($run);
        
        return $run->affected_rows;
    }
    
    // takes a total and returns the total with a coupon applied
    // if coupon code is null, total is returned
    public function applyCouponToTotal($total,$coupon_id) {
        if (!is_null($coupon_id)) {
            $coupon = new Coupon($coupon_id);
            $value = $coupon->getValue();
            if ($value < 1) {
                $total = $total - ($total * $value);
            }
            else {
                $total -= $value;
            }
        }
        return $total;
    }
}