<?php 
    if(isset($_GET["user"]) && isset($_COOKIE["score"])){
        $user = $_GET["user"];
        $score = $_COOKIE["score"];
        $data = $user . ":" . $score . "\n";
        file_put_contents("./leaderboard.txt", $data, FILE_APPEND);
    }
    header("Location: ./login.php?logout=true");
?>