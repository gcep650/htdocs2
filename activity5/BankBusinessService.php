<?php
require_once('Autoloader.php');

class BankBusinessService {
    
    public function getCheckingBalance() {
        $db = new Database();
        $conn = $db->getConnection();
        
        $checkingService = new CheckingAccountDataService(1,$conn);
        $balance = $checkingService->getBalance();
        
        $conn->close();
        return $balance;
    }
    
    public function getSavingBalance() {
        $db = new Database();
        $conn = $db->getConnection();
        
        $savingService = new SavingAccountDataService(1,$conn);
        $balance = $savingService->getBalance();
        
        $conn->close();
        return $balance;
    }
    
    public function transaction($transfer) {
        $db = new Database();
        $conn = $db->getConnection();
        
        $conn->autocommit(FALSE);
        $conn->begin_transaction();
        
        $checkingBalance = $this->getCheckingBalance();
        
        $checking = new CheckingAccountDataService(1, $conn);
        $okchecking = $checking->updateBalance($checkingBalance - $transfer);
        
        $savingBalance = $this->getSavingBalance();
        
        $saving = new SavingAccountDataService(1, $conn);
        $oksavings = $saving->updateBalance($savingBalance + $transfer);
        
        if ($okchecking && $oksavings) {
            $conn->commit();
            echo "Transfer successful!<br>";
        }
        else {
            $conn->rollback();
            echo "Transfer unsuccessful.<br>";
        }
        
        $conn->close();
       
    }
}