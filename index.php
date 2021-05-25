<?php 
    include_once 'mainpage.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css"/>
</head>
<body>
    <nav class="Main-navbar">
        <h1 style="float:left;"><a href="index.php">Wszystko i nic - sklep internetowy</a></h1>
        <?php
            if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true){
                echo '<h2 class="nav-options">Witaj, ' . htmlspecialchars($_SESSION["name"]) . '</h2>';
                echo '<h2 class="nav-options"><a href="logout.php">Wyloguj się</a></h2>';
            }
            else{
                echo '<h2 class="nav-options"><a href="register.php">Zarejestruj się</a></h2>';
                echo '<h2 class="nav-options"><a href="login.php">Zaloguj się</a></h2>';
            }
        ?>
    </nav>
    <nav class="Sidebar">
        <ul><h2>Kategorie:</h2>
            <li>Gry</li>
            <li>Konsole</li>
            <li>Laptopy</li>
        </ul>
    </nav>
    <?php
        if($result1->num_rows>0){
            while($row = $result1-> fetch_assoc()){?>
            <div class="container">
                <h1><?php echo $row['name'] ?></h1>
                <h3><?php echo $row['category_name'] ?></h3>
                <h3>Dostępność: <?php
                    if($row['onStock'] == 1)
                        echo "Dostepny!";
                    else
                        echo "Brak towaru";
                ?></h3>
                <h3 style="float: left;"><?php echo $row['price'] . " zł"; ?>&#8194;</h3>
                <button style="float: left;" type="button"><a href="order.php"> Zamów teraz!</a></button>
            </div>
            <?php }
        }
        $conn->close();
    ?>
</body>
</html>