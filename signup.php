<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Signup</title>
        <link rel="stylesheet" href="./style.css">
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
            <form action="./signup-submit.php" method="post">
            <ul>
                    <li>
                        <strong><label for="uname">Username:</label></strong>
                        <input type="text" name="username" id="uname" maxlength="25">
                    </li>
                    <li>
                        <strong><label for="pword">Password:</label></strong>
                        <input type="password" name="password" id="pword" maxlength="30">
                    </li>
                    <li>
                    <strong><label for="pword">Repeat Password:</label></strong>
                        <input type="password" name="rpassword" id="rpword" maxlength="30">
                    </li>
                    <button type="submit" class="submitBtn">Signup</button>
                    <br>
                    Have an account? <a href="./login.php">Login</a>
                </ul>
            </form>
        </div>
    </body>
</html>