<?php 
    include("./common.php");
    session_start();

    $users = load_users();

    $status = "";
    $errors = [];

    //Validate user input
    if(!isset($_POST["username"]) || $_POST["username"] == ""){
        $status = "error";
        $errors[] = "Please enter a username.";
    }

    if(isset($_POST["username"]) && array_key_exists($_POST["username"], $users)){
        $status = "error";
        $errors[] = "User already exists.";
    }

    if(!isset($_POST["password"]) || $_POST["password"] == ""){
        $status = "error";
        $errors[] = "Please enter a password."; 
    }

    if(!isset($_POST["rpassword"]) || $_POST["rpassword"] == ""){
        $status = "error";
        $errors[] = "Please confirm password."; 
    }

    if(isset($_POST["password"]) && isset($_POST["rpassword"]) && $_POST["password"] != $_POST["rpassword"]){
        $status = "error";
        $errors[] = "Passwords do not match.";
    }

    if($status == "error"){
        $_SESSION["status"] = $status;
        $_SESSION["errors"] = $errors;
        header("Location: ./signup.php");
    }
    else{
        //Store credentials in text file
        $username = $_POST["username"];
        $password = $_POST["password"];
        $credentials = $username . ":" . $password . "\n";
        file_put_contents("users.txt", $credentials, FILE_APPEND);
        session_destroy();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./style.css">
        <title>Signup</title>
    </head>
    <body>
        <header>
            <h1>Game of Life</h1>
        </header>
        <div id="container">
            <h3>Welcome, <?=$username?>!</h3>
            <a href="./login.php"><button type="submit" class="submitBtn">Login</button></a>
        </div>
    </body>
</html>