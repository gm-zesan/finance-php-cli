<?php
    function initializeFile($filename, $initialContent = "") {
        if (!file_exists($filename)) {
            $file = fopen($filename, "w");
            fwrite($file, $initialContent);
            fclose($file);
        }
    }

    function currentBalance($message, $balance) {
        $file = fopen("current_balance.txt", "w");
        fwrite($file, $balance);
        fclose($file);
        echo $message . $balance . PHP_EOL;
    }

    function appendToFile($filename, $data) {
        $file = fopen($filename, "a");
        fwrite($file, json_encode($data) . PHP_EOL);
        fclose($file);
    }

    function viewFileData($filename) {
        $file = fopen($filename, "r");
        while (!feof($file)) {
            $data = fgets($file);
            if ($data !== false) {
                echo $data . PHP_EOL;
            }
        }
        fclose($file);
    }

    function calculateTotalAmount($filename) {
        $file = fopen($filename, "r");
        $total = 0;
        while (!feof($file)) {
            $data = fgets($file);
            if ($data !== false) {
                $data = json_decode(trim($data), true);
                $total += $data["Amount"];
            }
        }
        fclose($file);
        return $total;
    }

    function getCurrentBalance() {
        $file = fopen("current_balance.txt", "r");
        $balance = (int) fgets($file);
        fclose($file);
        return $balance;
    }

?>