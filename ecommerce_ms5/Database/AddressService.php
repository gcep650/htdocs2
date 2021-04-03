<?php
require_once("../Database/DBConnection.php");
require_once("../Database/Address.php");

class AddressService {
    private $conn;
    
    public function __construct() {
        $db = new DBConnection();
        $this->conn = $db->getCon();
    }
    
    public function getAddressesFromUser($id) {
        $query = "SELECT * FROM addresses WHERE USER_ID=?";
        $run = $this->conn->prepare($query);
        $run->bind_param('i', $id);
        $run->execute();
        
        $result = $run->get_result();
        
        $addresses = array();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc())
            {
                array_push($addresses, new Address($row['ADDRESS_ID']));
            }
        }
        
        return $addresses;
    }
    
    public function createAddress($user_id,$street,$city,$state,$zip) {
        $query = "INSERT INTO addresses (USER_ID,STREET,CITY,STATE,ZIP) VALUES (?,?,?,?,?)";
        $run = $this->conn->prepare($query);
        $run->bind_param('isssi', $user_id,$street,$city,$state,$zip);
        $run->execute();
        
        return $run->affected_rows;
    }
}