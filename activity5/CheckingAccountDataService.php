<?php
require_once("Database.php");

class CheckingAccountDataService {
    private $con;
    private $id;
    
    public function __construct(int $id, $conn) {
        $this->con = $conn;
        $this->id = $id;
    }
    
    public function getBalance() {
        $query = "SELECT * FROM checking WHERE ID=?";
        $run = $this->con->prepare($query);
        $run->bind_param('i', $this->id);
        $run->execute();
        
        $result = $run->get_result();
        
        if ($result->num_rows > 0) {
            $info = $result->fetch_assoc();
            return $info['BALANCE'];
        }
    }
    
    public function updateBalance($balance) {
        $query = "UPDATE checking SET BALANCE=? WHERE ID=?";
        $run = $this->con->prepare($query);
        $run->bind_param('di',$balance, $this->id);
        $run->execute();
        
        return $run->affected_rows;
    }
}