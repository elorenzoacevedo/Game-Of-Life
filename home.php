<?php 
    include("./common.php");
    session_start();
    $status = "";
    $errors = [];

    //Validate user input
    if(!isset($_POST["username"]) || $_POST["username"] == ""){
        $status = "error";
        $errors[] = "Please enter a username.";
    }

    if(!isset($_POST["password"]) || $_POST["password"] == ""){
        $status = "error";
        $errors[] = "Please enter a password.";
    }

    if($status == "error" && !isset($_SESSION["user"])){
        $_SESSION["status"] = $status;
        $_SESSION["errors"] = $errors;
        header("Location: ./login.php");
    }
    else {
        if(!isset($_SESSION["user"])){
            $username = $_POST["username"];
            $password = $_POST["password"];
        }
        else {
            $username = $_SESSION["user"];
        }
   

        if(!isset($_SESSION["user"]) && !validate_user($username, $password)){
            $errors[] = "Username and/or password is incorrect.";
            $_SESSION["status"] = "error";
            $_SESSION["errors"] = $errors;
            header("Location: ./login.php");
        }
        else {
            $_SESSION["user"] = $username;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./style.css">
        <title>Home</title>
    </head>
    <body>
        <header>
            <h1>Game of Life</h1>
        </header>
        <div id="container">
            <h3>Hi, <?=$username?></h3>
            
            <section>
                <a href="./game.php?user=<?=$username?>"><button class="btn">Play</button></a>
            </section>
            <a href="./leaderboard.php"><button class="btn" id="leaderboardBtn">Leaderboard</button></a>
            <a href="./login.php?logout=true"><button class="btn">Log Out</button></a>
        </div>
    </body>
</html>