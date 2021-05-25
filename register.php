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
        $fnameError = "";
        $lnameError = "";
        $emailError = "";
        $passwordError = "";
        $cityError = "";
    ?>
    <p id="hello"><a href="index.php">Wszystko i nic - <br> sklep internetowy</a></p>
    <div id="formBorder">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Imię: 
            <input type="text" name="firstName" required><br>
            <span><?php echo $fnameError ?></span><br><br>
            Nazwisko: 
            <input type="text" name="lastName" required><br>
            <span><?php echo $lnameError ?></span><br><br>
            Email: 
            <input type="email" name="email" required><br>
            <span><?php echo $emailError ?></span><br><br>
            Hasło:
            <input type="password" name="password" required><br>
            <span><?php echo $passwordError ?></span><br><br>
            Adres zamieszkania:
            <input type="text" name="address" required><br><br>
            Miasto: 
            <input type="text" name="city" required><br>
            <span><?php echo $cityError ?></span><br><br>
            <button type="submit">Załóż konto</button>
        </form>
    </div>
    <?php
        include 'register_query.php';

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            /*$firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $email = $_POST["email"];
            $city = $_POST["city"];*/
            $address = $_POST["address"];
            //$password = $_POST["password"];
            $passwordNum = preg_match('@[0-9]@', $_POST["password"]);
            $passwordUp = preg_match('@[A-Z]@', $_POST["password"]);
            $passwordLow = preg_match('@[a-z]@', $_POST["password"]);

            if(!preg_match("/^[a-zA-Z-' ]*$/", $_POST["firstName"]))
                $fnameError = "Pole zawiera niedozwolone znaki!";
            else
                $firstName = $_POST["firstName"];

            if(!preg_match("/^[a-zA-Z-' ]*$/", $_POST["lastName"]))
                $lnameError = "Pole zawiera niedozwolone znaki!";
            else
                $lastName = $_POST["lastName"];

            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                $emailError = "Podany email jest nieprawidłowy!";
            else
                $email = $_POST["email"];

            if(!$passwordNum || !$passwordUp || !$passwordLow)
                $passwordError = "Twoje hasło nie spełnia wymogów bezpieczeństwa!";
            else
                $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

            if(!preg_match("/^[a-zA-Z-' -.]*$/", $_POST["city"]))
                $cityError = "Pole zawiera niedozwolone znaki!";
            else
                $city = $_POST["city"];

            createUser($firstName, $lastName, $email, $password, $address, $city);
        }
    ?>
</body>
</html>