<?php
    function connectdb(){
        $servername = "http://3.25.52.37/";
        $username = "root";
        $password = "admin";

        try {
        $conn = new PDO("mysql:host=$servername;dbname=new_database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully"
        } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }
        // trả về conn để các table khác select dữ liệu về
        return $conn;
    }
?>