<?php 
    if(isset($_GET["user"])){
        $user = $_GET["user"];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./game.css">
        <script src="./game.js"></script>
        <title>Game of Life</title>
    </head>
    <body>
        <header>
            <h2>Conway's Game of Life</h2>
        </header>
        <div id="config">
            <h2>Enter # of rows & columns</h2>
            <form id="configs">
                <ul>
                    <li>
                        <strong><label for="rows">Rows:</label></strong>
                        <input type="text" id="rows" size="3">
                    </li>
                    <li>
                        <strong><label for="columns">Columns:</label></strong>
                        <input type="text" id="columns" size="3">
                    </li>
                    <span>Columns: Anything greater than 50 will be set to 50.</span>
                </ul>
            </form>
            <button type="submit" class="okbtn" onclick="configure()">OK</button>
        </div>

        <div id="dropdown">
            <select name="patters" id="pat" class="hidden" onchange="setPattern()">
                <option value="">(Select a pattern)</option>
                <option value="lightweight_spaceship">Lightweight Spaceship</option>
                <option value="beehive">Beehive</option>
                <option value="blinker">Blinker</option>
                <option value="toad">Toad</option>
                <option value="pulsar">Pulsar</option>
            </select>
        </div>
        <div id="grid"></div>

        <div id="buttons" class="hidden">
            <button id="start" onclick="startGame()">Start</button>
            <button id="advance1" onclick="gameProgress()">+1 Gen</button>
            <button id="advance23" onclick="advanceTwentyThreeGen()">+23 Gen</button>
            <button id="stop" onclick="stopGame()">Stop</button>
            <button id="clear" onclick="clearGrid()">Clear</button>
        </div>

        <div class="center" id="score">Score: 0</div>

        <div class="center" id="logout">
            <a href='./leaderboard-submit.php?user=<?=$user?>'><button class="btn" onclick="cookieScore()">Logout</button></a>
            <a href="./home.php"><button class="btn">Home</button></a>
        </div>
    </body>
</html>