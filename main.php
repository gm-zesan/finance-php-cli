<?php
    require_once 'helper.php';
    class Main{

        private $categories = [
            ["name" => "Salary", "type" => "Income"],
            ["name" => "Business", "type" => "Income"],
            ["name" => "Bonus", "type" => "Income"],
            ["name" => "Gift", "type" => "Income"],
            ["name" => "Food", "type" => "Expense"],
            ["name" => "Transport", "type" => "Expense"],
            ["name" => "Shopping", "type" => "Expense"],
            ["name" => "Sadakah", "type" => "Expense"],
        ];

        public function __construct() {
            initializeFile("income.txt");
            initializeFile("expense.txt");
            initializeFile("current_balance.txt", "0");
        }
    
        




        public function addIncome($amount, $category) {
            $data = ["Amount" => $amount, "Category" => $category];
            appendToFile("income.txt", $data);
    
            $balance = getCurrentBalance();
            $newBalance = $balance + $amount;
            $message = "Current balance is: $balance + $amount = ";
            currentBalance($message, $newBalance);
        }

        public function viewIncomes() {
            viewFileData("income.txt");
        }



        public function addExpense($amount, $category) {
            $balance = getCurrentBalance();
    
            if ($balance < $amount) {
                echo "Insufficient balance" . PHP_EOL;
                return;
            }
    
            $data = ["Amount" => $amount, "Category" => $category];
            appendToFile("expense.txt", $data);
    
            $newBalance = $balance - $amount;
            $message = "Current balance is: $balance - $amount = ";
            currentBalance($message, $newBalance);
        }



        public function viewExpenses() {
            viewFileData("expense.txt");
        }

        public function viewSavings() {
            $totalIncome = calculateTotalAmount("income.txt");
            $totalExpense = calculateTotalAmount("expense.txt");

            echo "Total Income: $totalIncome\n";
            echo "Total Expense: $totalExpense\n";

            $savings = $totalIncome - $totalExpense;
            echo "Total savings is: $totalIncome - $totalExpense = $savings" . PHP_EOL;
        }

        public function viewCategories(){
            $nameColWidth = 15;
            $typeColWidth = 10;
    
            $border = str_repeat("-", $nameColWidth + $typeColWidth + 7);
    
            echo $border . "\n";
            printf("| %-{$nameColWidth}s | %-{$typeColWidth}s |\n", "Category", "Type");
            echo $border . "\n";
    
            foreach($this->categories as $category){
                printf("| %-{$nameColWidth}s | %-{$typeColWidth}s |\n", $category["name"], $category["type"]);
            }
    
            echo $border . "\n";
        }

        public function categoryExists($category){
            $category = strtolower($category);
            foreach($this->categories as $cat){
                if(strtolower($cat["name"]) == $category){
                    return true;
                }
            }
            return false;
        }
    }
?>