<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="register.css"/>
</head>
<body>
    <?php
        $errormsg = "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_SESSION["loggedin"])){
                if($_SESSION["loggedin"] == true)
                    header("Location: index.php");
            }
            else{
                $email = $_POST["email"];
                $password = $_POST["password"];
                $conn = new mysqli("localhost", "root", "", "store");
                if($conn->connect_error){
                    die("Błąd połączenia z bazą danych " . $conn->connect_error);
                }
                $hash_password_query = $conn->query("SELECT password FROM users where email = '$email'");
                if($hash_password_query->num_rows>0){
                    $row_passwd = $hash_password_query->fetch_assoc();
                    $ver_password = password_verify($password, $row_passwd["password"]);
                    if($ver_password == true){
                        session_start();
                        $name = $conn->query("SELECT firstName from users where email = '$email'");
                        $_SESSION["email"] = $email;
                        $_SESSION["loggedin"] = true;
                        if($name->num_rows > 0){
                            $row_name = $name->fetch_assoc();
                            $_SESSION["name"] = $row_name["firstName"];
                        }
                        else{
                            die("Coś poszło nie tak :(");
                        }
                        header("Location: index.php");
                    }
                }
                else
                    $errormsg = "Nieprawidłowy email lub hasło.";
                $conn->close();
            }
        }
    ?>
    <p id="hello"><a href="index.php">Wszystko i nic - <br> sklep internetowy</a></p>
    <div id="formBorder">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Email: 
            <input type="email" name="email"><br><br>
            Hasło:
            <input type="password" name="password"><br>
            <span><?php echo $errormsg . "<br>"?></span>
            <button type="submit">Zaloguj się</button>
        </form>
    </div>
</body>
</html>