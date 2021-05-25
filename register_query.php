<?php
    function createUser($fname, $lname, $email, $password, $address, $city){
        $conn = new mysqli("localhost", "root", "", "store");

        if($conn->connect_error){
            die("Błąd połączenia: " . $conn->connect_error);
        }
        if(empty($fname) ||
        empty($lname) ||
        empty($email) ||
        empty($password) ||
        empty($city) ||
        empty($address)){
            die("cos jest puste");
        }
        else{
            $sql = "INSERT INTO users VALUES(0, '$fname', '$lname', '$email', '$password', '$address', '$city', 0)";
            $conn->query($sql);
            
            if($conn->error) 
                die("Błąd tworzenia użytkownika: ". $conn->error);
            else
                header('Location: index.php');
        }

        
        $conn->close();

        exit();
    }
?>