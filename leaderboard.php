<?php
session_start();
//Define function for sorting leaderboard
function cmp($a, $b){
    return $b["score"] - $a["score"];
}

//Get input file
$players = fopen("leaderboard.txt", "r");
$count = 0;
$leaderboard = array();

//Store file data in array
while (!feof($players)) {
    $line = fgets($players);
        if($line != ""){
        $playerData = explode(":", $line);
        $playerData[1] = trim($playerData[1]);
        $playerData[1] = trim($playerData[1], "$");
        $leaderboard[$count] = ["user" => $playerData[0], "score" => floatval($playerData[1])];
        $count++;
    }
}
usort($leaderboard, "cmp"); //Sort in descending order

//Display table
echo "<table>";
echo "<tr id =title>Leaderboard</tr>";

foreach($leaderboard as $user){
    echo "<tr>";
        echo "<td>" . $user['user'] . "</td>";
            echo "<td>Generations: " . $user['score'] . "</td>";
    echo "</tr>";
}

echo "</table>";

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <a href="./home.php"><button class="btn">Home</button></a>
    </body>
</html>