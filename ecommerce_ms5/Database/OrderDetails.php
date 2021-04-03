<?php
require_once("../Database/Autoloader.php");
class OrderDetails {
    private $order_details_id;
    private $order_id;
    private $product_id;
    private $quantity;
    private $current_price;
    
    public function __construct($id) {
        $db = new DBConnection();
        $this->conn = $db->getCon();
        $this->order_details_id = $id;
        
        $this->updateValues();
    }
    
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
    
    public function getProduct() {
        return new Product($this->product_id);
    }
    
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

}