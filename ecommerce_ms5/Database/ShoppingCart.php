<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.3
 * Module name: Shopping Cart Class
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a class that represents the user's shopping cart.
 */
require_once("../Database/DBConnection.php");
require_once("../Database/Product.php");
require_once("../Database/CartItem.php");

class ShoppingCart {
    private $cart_id;
    private $user_id;
    private $items;
    private $db;
    
    
    // returns the total price of the user's shopping cart
    function totalPrice() {
        // update the items
        $this->getItems();
        foreach ($this->items as $item) {
            $product = $item->getProduct();
            // add the product price times the quantity to the total
            $total += $product->getPrice() * $item->getQuantity();
        }
        return $total;
    }
    
    // returns the total number of different items in the user's shopping cart
    function itemCount() {
        $this->getItems();
        return count($this->items);
    }
    
    // update an item's quantity in the cart based on the cart_item_id value (PK of cart_items table)
    function updateItem($cart_item_id,$quantity) {
        $this->getItems();
        foreach ($this->items as $item) {
            if ($item->getCartItemId() == $cart_item_id) {
                $item->updateItem($quantity);
            }
        }
    }
    
    
    // update an item's quantity in the cart by the product id
    function updateItemById($item_id,$quantity) {
        $this->getItems();
        foreach ($this->items as $item) {
            if ($item->getProductId() == $item_id) {
                $item->updateItem($quantity);
            }
        }
    }
    
    // remove an item in the cart by the cart_item_id value (PK of cart_items table)
    function removeItem($cart_item_id) {
        $this->getItems();
        foreach ($this->items as $item) {
            if ($item->getCartItemId() == $cart_item_id) {
                $item->removeItem();
            }
        }
    }
    
    // remove an item from the cart by the product_id
    function removeItemById($item_id) {
        $this->getItems();
        foreach ($this->items as $item) {
            if ($item->getProductId() == $item_id) {
                $item->removeItem();
            }
        }
    }
    
    // returns an array of CartItem objects, representing each item in the user's cart
    function getItems() {
        $items = array();
        
        $con = $this->db->getCon();
        
        $query = "SELECT * FROM cart_items WHERE CART_ID = ?";
        
        $run = $con->prepare($query);
        
        $run->bind_param('i', $this->cart_id);
        
        $run->execute();
        
        $result = $run->get_result();
        
        // create a new CartItem using the cart_item_id and push it into the array
        while ($row = $result->fetch_assoc()) {
            $item = new CartItem($row['CART_ITEM_ID']);
            array_push($items, $item);
        }
        
        $this->items = $items;
        
        return $items;
    }
    
    // add an item to the user's cart. takes in product_id and quantity
    function addItem(int $item_id, int $quantity) {
        $con = $this->db->getCon();
        
        $query = "INSERT INTO cart_items (CART_ID,PRODUCT_ID,QUANTITY) VALUES (?,?,?)";
        
        $run = $con->prepare($query);
        
        $run->bind_param("iii",$this->cart_id,$item_id,$quantity);
        
        $run->execute();
        
        if ($run->affected_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }
    
    // creates the shopping cart. if a shopping cart for the specified user is not found,
    // a shopping cart entry is created in the database
    function __construct(int $id) {
        $this->db = new DBConnection();
        $this->user_id = $id;
        
        $con = $this->db->getCon();
        
        $query = "SELECT * FROM shopping_carts WHERE USER_ID=?";
        
        $run = $con->prepare($query);
        $run->bind_param('i', $id);
        $run->execute();
        
        $results = $run->get_result();
        
        // check if user has a shopping cart created
        if ($results->num_rows == 1) {
            $info = $results->fetch_assoc();
            
            $this->cart_id = $info['CART_ID'];
            
            //echo "Cart found.<br>";
            
        }
        else {
            //echo "Cart not found. Creating cart...<br>";
            $this->createCart();
        }
    }
    
    // creates a shopping cart entry for the specified user
    private function createCart() {
        $con = $this->db->getCon();
        
        $query = "INSERT INTO shopping_carts (USER_ID,DATE_CREATED) VALUES (?,NOW())";
        
        $run = $con->prepare($query);
        
        $run->bind_param('i', $this->user_id);
        
        $run->execute();
        
        if ($run->affected_rows > 0) {
            $query = "SELECT * FROM shopping_carts WHERE CART_ID=LAST_INSERT_ID()";
            
            $run->prepare($query);
            
            $run->execute();
            
            $result = $run->get_result();
            
            if ($result->num_rows > 0) {
                $info = $result->fetch_assoc();
                $this->cart_id = $info['CART_ID'];
            }
            else {
                throw new Exception("Failed to get cart.");
            }
        }
        else {
            throw new Exception("Failed to insert cart.");
        }
    }

    public function getCart_id()
    {
        return $this->cart_id;
    }

    /**
     * @return int
     */
    public function getUser_id()
    {
        return $this->user_id;
    }
    
    public function destroy() {
        $query = "DELETE FROM shopping_carts WHERE CART_ID=?";
        $run = $this->db->getCon()->prepare($query);
        $run->bind_param('i', $this->cart_id);
        $run->execute();
        
        return $run->affected_rows;
    }

}