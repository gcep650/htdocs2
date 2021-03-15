<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.3
 * Module name: Cart Item Class
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a class that holds an item from the user's Shopping Cart.
 */
require_once("../Database/DBConnection.php");

class CartItem {
    private $cart_item_id;
    private $cart_id;
    private $product_id;
    private $quantity;
    private $db;
    
    // create a new CartItem from the cart_item_id
    function __construct($id) {
        $this->db = new DBConnection();
        $this->cart_item_id = $id;
        $this->fetchValues();
        
    }
    
    // this function fetches the cart item information from the database and
    // sets the class variables to the database values
    function fetchValues() {
        $con = $this->db->getCon();
        
        $query = "SELECT * FROM cart_items WHERE CART_ITEM_ID=?";
        
        $run = $con->prepare($query);
        
        $run->bind_param('i', $this->cart_item_id);
        
        $run->execute();
        
        $result = $run->get_result();
        
        if ($result->num_rows > 0) {
            $info = $result->fetch_assoc();
            $this->cart_id = $info['CART_ID'];
            $this->product_id = $info['PRODUCT_ID'];
            $this->quantity = $info['QUANTITY'];
            return true;
        }
        else {
            return false;
        }
    }
    
    // returns the item the CartItem represents as a Product
    function getProduct() {
        return new Product($this->product_id);
    }
    
    // sets the values from the CartItem class and inserts them into the corresponding database row
    function setValues() {
        $con = $this->db->getCon();
        
        $query = "UPDATE cart_items SET QUANTITY=? WHERE CART_ITEM_ID=?";
        
        $run = $con->prepare($query);
        
        $run->bind_param("ii",$this->quantity,$this->cart_item_id);
        
        $run->execute();
        
        return $run->affected_rows > 0;
    }
    
    // removes the current CartItem from the database.
    function removeItem() {
        $con = $this->db->getCon();
        
        $query = "DELETE FROM cart_items WHERE CART_ITEM_ID=?";
        
        $run = $con->prepare($query);
        
        $run->bind_param('i',$this->cart_item_id);
        
        $run->execute();
        
        return $run->affected_rows > 0;
    }
    
    // updates the quantity in the database using the quantity variable in the class
    function updateItem($quantity) {
        $this->setQuantity($quantity);
        $this->setValues();
    }
    
    /**
     * @return mixed
     */
    public function getCartItemId()
    {
        return $this->cart_item_id;
    }

    /**
     * @return mixed
     */
    public function getCartId()
    {
        return $this->cart_id;
    }

    /**
     * @return mixed
     */
    public function getProductId()
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
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    

}