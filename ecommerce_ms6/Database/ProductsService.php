<?php
/*
 * Project Name: CST-236 Ecommerce Application
 * Version: 1.2
 * Module name: Products Service Module
 * Module version: 1.1
 * Authors: Gabriel Cepleanu
 * Synopsis: This module provides a class with functions related to access to products,
 * such as search and getting products.
 */
require_once('DBConnection.php');
require_once('../Database/Product.php');
//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);
class ProductsService {
    
    // no arguments. returns array of all products in the products table
    function getAllProducts() {
        // get connection class
        $db = new DBConnection();
        
        // get connection
        $connect = $db->getCon();
        
        // create query
        $query = "SELECT * FROM products";
        
        // prepare query
        $run = $connect->prepare($query);
        
        // execute query
        $run->execute();
        
        $results = $run->get_result();
        
        $products = array();
        
        // keep placing products into array until all have been pushed
        while($product = $results->fetch_assoc()) {
            array_push($products, $product);
        }
        
        return $products;
    }
    
    // returns the number of pages to display all items
    function getPageCount() {
        $db = new DBConnection();
        
        $connect = $db->getCon();
        
        $query = "SELECT * FROM products";
        
        $run = $connect->prepare($query);
        
        $run->execute();
        
        $results = $run->get_result();
        
        // since there will always be at most 10 items per page, page count can be found by
        // finding the total divided by 10
        return $results->num_rows / 10;
    }
    
    // returns a list of products given a page number (page = 10 items)
    function getProductsByPage(int $page) {
        $db = new DBConnection();
        
        $connect = $db->getCon();
        
        $index = $page * 10;
        
        // select query, ordered by product id and limited to 10 results
        $query = "SELECT * FROM products WHERE PRODUCT_ID > ? ORDER BY PRODUCT_ID LIMIT 10";
        
        $run = $connect->prepare($query);
        
        $run->bind_param('i',$index);
        
        $run->execute();
        
        $results = $run->get_result();
        
        $products = array();
        
        while($product = $results->fetch_assoc()) {
            array_push($products, $product);
        }
        
        return $products;
    }
    
    // returns a product given its ID number
    function getProductById(int $id) {
        
        $db = new DBConnection();
        
        $connect = $db->getCon();
        
        $query = "SELECT * FROM products WHERE PRODUCT_ID=?";
        
        $run = $connect->prepare($query);
        
        $run->bind_param('i', $id);
        
        $run->execute();
        
        $results = $run->get_result();
        
        if ($results->num_rows == 1) {
            $product = $results->fetch_assoc();
            return $product;
        }
        
        return null;
    }
    
    // creates product from given parameters using SQL INSERT INTO
    function createProduct($name,$description,$price,$quantity,$image_path) {
        $db = new DBConnection();
        
        $con = $db->getCon();
        
        $query = "INSERT INTO products (NAME,DESCRIPTION,PRICE,QUANTITY,IMAGE_PATH) VALUES (?,?,?,?,?)";
        
        $run = $con->prepare($query);
        
        $run->bind_param('ssdis', $name,$description,$price,$quantity,$image_path);
        
        $run->execute();
        
        return $run->affected_rows > 0;
    }
    
    // returns a list of products given a name and search type.
    // search type is predefined names from search.html
    // $type - the type of search (contains, starts with)
    // $search - the search input from the user
    function searchByName($search, $type) {
        $db = new DBConnection();
        
        $connect = $db->getCon();
        
        $query = "SELECT * FROM products WHERE NAME LIKE ?";
        
        $run = $connect->prepare($query);
        
        $searchType = $this->getSearchType($type, $search);
        
        $run->bind_param('s',$searchType);
        
        $run->execute();
        
        $results = $run->get_result();
        
        $products = array();
        
        if ($results->num_rows > 0) {
            while($product = $results->fetch_assoc()) {
                array_push($products, $product);
            }
            return $products;
        }
        return null;
    }
    
    // helper method for searchByName().
    // $type - the type of search (contains, starts with)
    // $search - the search input from the user
    private function getSearchType($type, $search) {
        switch($type) {
            case "start":
                return $search . "%";
            case "end":
                return "%" . $search;
            default:
                return "%" . $search . "%";
        }
    }
}