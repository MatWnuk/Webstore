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
        $fnameError = $cityError = $passwordError = $emailError = $lnameError = "";
        $firstName = $lastName = $email = $password = $address = $city ="";
        include 'register_query.php';

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $address = $_POST["address"];
            $passwordNum = preg_match('@[0-9]@', $_POST["password"]);
            $passwordUp = preg_match('@[A-Z]@', $_POST["password"]);
            $passwordLow = preg_match('@[a-z]@', $_POST["password"]);

            if(!preg_match("/^[a-zA-ZąęćżźńłóśĄĆĘŁŃÓŚŹŻ' .]+$/", $_POST["firstName"]))
                $fnameError = "Pole zawiera niedozwolone znaki!";
            else
                $firstName = $_POST["firstName"];

            if(!preg_match("/^[a-zA-ZąęćżźńłóśĄĆĘŁŃÓŚŹŻ' .]+$/", $_POST["lastName"]))
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

            if(!preg_match("/^[a-zA-ZąęćżźńłóśĄĆĘŁŃÓŚŹŻ.]+$/", $_POST["city"]))
                $cityError = "Pole zawiera niedozwolone znaki!";
            else
                $city = $_POST["city"];

            createUser($firstName, $lastName, $email, $password, $address, $city);
        }
    ?>
    <p id="hello"><a href="index.php">Wszystko i nic - <br> sklep internetowy</a></p>
    <div id="formBorder">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Imię: 
            <input type="text" name="firstName" required><br>
            <span><?php echo $fnameError . "<br>" ?></span>
            Nazwisko: 
            <input type="text" name="lastName" required><br>
            <span><?php echo $lnameError . "<br>" ?></span>
            Email: 
            <input type="email" name="email" required><br>
            <span><?php echo $emailError . "<br>" ?></span>
            Hasło: 
            <input type="password" name="password" required><br>
            <span><?php echo $passwordError . "<br>" ?></span>
            Adres zamieszkania: 
            <input type="text" name="address" required><br><br>
            Miasto: 
            <input type="text" name="city" required><br>
            <span><?php echo $cityError . "<br>" ?></span>
            <button type="submit">Załóż konto</button>
        </form>
    </div>
</body>
</html>