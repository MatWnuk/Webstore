<?php
        $conn =  new mysqli("localhost", "root", "", "store");

        if($conn->connect_error){
            die("Błąd połączenia: " . $conn->connect_error);
        }
        $sql1 = "SELECT products.name, products.price, products.onStock, categories.category_name FROM products, categories where products.category = categories.category_id";
        $result1 = $conn->query($sql1);
?>