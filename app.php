<?php

    require_once 'main.php';

    $main = new Main();

    $main_menu = [
        "1" => "Add Income",
        "2" => "View Incomes",
        "3" => "Add Expense",
        "4" => "View Expenses",
        "5" => "View Savings",
        "6" => "View Categories",
        "7" => "Exit"
    ];

    while (true){
        echo "===========================================" . PHP_EOL;
        echo "               Main Menu                    " . PHP_EOL;
        echo "===========================================" . PHP_EOL;
        foreach ($main_menu as $key => $value) {
            printf("%-2s. %-20s\n", $key, $value);
        }
    
        echo "-------------------------------------------" . PHP_EOL;
    
        $option = readline("Choose an option (1-7): ");

        if($option == 1){
            $amount = (float)trim(readline("Enter amount: "));
            if ($amount <= 0) {
                echo "Amount must be a positive number." . PHP_EOL;
                continue;
            }
            $category = trim(readline("Enter category: "));
            if (!$main->categoryExists($category)) {
                echo "Invalid category." . PHP_EOL;
                continue;
            }
            $main->addIncome($amount, $category);
        } elseif($option == 2){
            $main->viewIncomes();
        } elseif($option == 3){
            $amount = (float)trim(readline("Enter amount: "));
            if ($amount <= 0) {
                echo "Amount must be a positive number." . PHP_EOL;
                continue;
            }
            $category = trim(readline("Enter category: "));
            if (!$main->categoryExists($category)) {
                echo "Invalid category." . PHP_EOL;
                continue;
            }
            $main->addExpense($amount, $category);
        } elseif($option == 4){
            $main->viewExpenses();
        } elseif($option == 5){
            $main->viewSavings();
        } elseif($option == 6){
            $main->viewCategories();
        } elseif($option == 7){
            echo "Exiting ";
            for($i = 0; $i < 3; $i++){
                echo ".";
                sleep(1);
            }
            echo PHP_EOL;
            break;
        } else {
            echo "Invalid option. Please choose a number from 1 to 7." . PHP_EOL;
        }
    }

?>