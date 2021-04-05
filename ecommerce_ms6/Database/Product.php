<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name: Product Class
 * Module version: 1.0
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a class with functions related to a product.
 */
require_once("../Database/DBConnection.php");
class Product implements JsonSerializable {
    private $id;
    private $name;
    private $description;
    private $price;
    private $quantity;
    private $image_path;
    private $db;
    
    // constructor to initialize Product class
    function __construct(int $id) {
        $this->db = new DBConnection();
        $this->id = $id;
        $this->updateInfo();
    }
    
    // updates the variables in the current class, replaces them with
    // most current information stored in the database
    function updateInfo() {
        $con = $this->db->getCon();
        $query = "SELECT * FROM products WHERE products.PRODUCT_ID=?;";
        
        $run = $con->prepare($query);
        $run->bind_param("i", $this->id);
        $run->execute();
        
        $result = $run->get_result();
        
        if ($result->num_rows == 1) {
            $info = $result->fetch_assoc();
            $this->name = $info['NAME'];
            $this->description = $info['DESCRIPTION'];
            $this->price = $info['PRICE'];
            $this->quantity = $info['QUANTITY'];
            $this->image_path = $info['IMAGE_PATH'];
        }   
    }
    
    // function that takes the variables from current class and inserts the information
    // into the corresponding row in the database
    // replaces information from database with the variables inside current class
    function setValues() {
        $con = $this->db->getCon();
        $query = "UPDATE products SET NAME=?, DESCRIPTION=?, PRICE=?, QUANTITY=?, IMAGE_PATH=? WHERE PRODUCT_ID=?";
        $run = $con->prepare($query);
        $run->bind_param("ssdisi", $this->name,$this->description,$this->price,$this->quantity,$this->image_path,$this->id);
        $run->execute();
        
        return $run->affected_rows > 0;
    }
    
    // deletes the current product from the database
    public function deleteProduct() {
        $con = $this->db->getCon();
        $query = "DELETE FROM products WHERE PRODUCT_ID=?";
        
        $run = $con->prepare($query);
        $run->bind_param('i', $this->id);
        $run->execute();
        
        return $run->affected_rows > 0;
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
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
    public function getImagePath()
    {
        return $this->image_path;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @param mixed $image_path
     */
    public function setImagePath($image_path)
    {
        $this->image_path = $image_path;
    }
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        array_pop($vars);
        return $vars;
    }


    
}