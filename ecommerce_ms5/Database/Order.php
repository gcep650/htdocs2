<?php
require_once("../Database/Autoloader.php");
class Order {
    private $order_id;
    private $date;
    private $user_id;
    private $address_id;
    private $conn;
    
    public function getTotal() {
        $items = $this->getOrderDetails();
        $total = 0;
        foreach ($items as $item) {
            $total += $item->getCurrent_price() * $item->getQuantity();
        }
        return $total;
    }
    
    public function __construct($id) {
        $db = new DBConnection();
        $this->conn = $db->getCon();
        $this->order_id = $id;
        
        $this->updateValues();
    }
    
    public function addItem($product_id,$quantity) {
        $query = "INSERT INTO order_details (ORDER_ID,PRODUCT_ID,QUANTITY,CURRENT_PRICE) VALUES (?,?,?,?)";
        $run = $this->conn->prepare($query);
        $product = new Product($product_id);
        
        $run->bind_param('iiid', $this->order_id,$product_id,$quantity,$product->getPrice());
        $run->execute();
        
        return $run->affected_rows;
    }
    
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
        }
    }
    
    public function getOrderDetails() {
        $query = "SELECT * FROM order_details WHERE ORDER_ID=?";
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

}