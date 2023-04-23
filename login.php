<?php
    session_start();
    if(isset($_GET["logout"]) && $_GET["logout"] == true){
        session_destroy();
        header("Location: ./login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./style.css">
        <title>Login</title>
    </head>
    <body>
        <header>
            <h1>Game of Life</h1>
        </header>

        <?php 
            //Show errors
            if(isset($_SESSION["status"]) && $_SESSION["status"] == "error"): 
        ?>
        <div id="errors">
            <ul>
            <?php foreach($_SESSION["errors"] as $error): ?>
                <strong><li><?=$error?></li></strong>
            <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <div id="container">
            <form action="./home.php" method="post">
                <ul>
                    <li>
                        <strong><label for="uname">Username:</label></strong>
                        <input type="text" name="username" id="uname" maxlength="25">
                    </li>
                    <li>
                        <strong><label for="pword">Password:</label></strong>
                        <input type="password" name="password" id="pword" maxlength="30">
                    </li>
                </ul>
                <button type="submit" class="submitBtn">Login</button>
                <br>
                Don't have an account? <a href="./signup.php">Signup!</a>
            </form>
        </div>
    </body>
</html>