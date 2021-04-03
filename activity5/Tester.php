<?php
require_once("Autoloader.php");
/*
$checking = new CheckingAccountDataService(1);
$checkingBalance = $checking->getBalance();

echo "The checking balance is $" . $checkingBalance . "<br>";

echo "Take some money...<br>";

$checking->updateBalance($checkingBalance - 100);
$checkingBalance = $checking->getBalance();

echo "The checking balance is $" . $checkingBalance . "<br>";

$saving = new SavingAccountDataService(1);
$savingBalance = $saving->getBalance();

echo "The saving balance is $" . $savingBalance . "<br>";

echo "Add some money...<br>";

$saving->updateBalance($savingBalance + 100);
$savingBalance = $saving->getBalance();

echo "The saving balance is $" . $savingBalance . "<br>";
*/

$bank = new BankBusinessService();

echo "Current values:<br>";
echo "Checking: $" . $bank->getCheckingBalance() . "<br>";
echo "Savings: $" . $bank->getSavingBalance() . "<br>";
$bank->transaction(100);
echo "Checking: $" . $bank->getCheckingBalance() . "<br>";
echo "Savings: $" . $bank->getSavingBalance() . "<br>";




