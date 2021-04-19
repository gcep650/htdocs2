<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.6
 * Module name: Coupon Class
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module contains a class that represents a Coupon entry from the database.
 */
require_once("../Database/Autoloader.php");
class Coupon {
    private $coupon_id;
    private $coupon_code;
    private $value;
    private $conn;
    
    // create new coupon object. $id = id of coupon row in database table
    public function __construct($id) {
        $db = new DBConnection();
        $this->conn = $db->getCon();
        $this->coupon_id = $id;
        
        $this->updateValues();
        
    }
    
    // get values from the database and set the member variables of the current instance
    public function updateValues() {
        $query = "SELECT * FROM coupons WHERE COUPON_ID=?";
        $run = $this->conn->prepare($query);
        $run->bind_param('i', $this->coupon_id);
        $run->execute();
        
        $result = $run->get_result();
        
        if ($result->num_rows > 0) {
            $info = $result->fetch_assoc();
            
            $this->coupon_code = $info['COUPON_CODE'];
            $this->value = $info['VALUE'];
            
        }
        else {
            throw new Exception("Coupon was not found.");
        }
    }
    /**
     * @return mixed
     */
    public function getCoupon_id()
    {
        return $this->coupon_id;
    }

    /**
     * @return mixed
     */
    public function getCoupon_code()
    {
        return $this->coupon_code;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

}