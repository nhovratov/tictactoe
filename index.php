<?php
require_once "Classes/Board.php";
require_once "Classes/Player.php";
require_once "Classes/Bot.php";
require_once "Classes/TicTacToe.php";
$tictactoe = new TicTacToe(3);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tic-Tac-Toe</title>
    <meta name="description" content="Tic-Tac-Toe-Game. Here is a short description for the page. This text is displayed e. g. in search engine result listings.">
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<section>
    <h1>Tic-Tac-Toe</h1>
    <article id="mainContent">
        <h2>Your free browsergame!</h2>
        <p>Type your game instructions here...</p>
        <form method="get" action="index.php">
            <table class="tic">
            <?php
            for ($i = 1; $i <= $tictactoe->getDimension(); $i++) {
                echo "<tr>";
                for ($j = 1; $j <= $tictactoe->getDimension(); $j++) {
                    echo "<td><input type=\"submit\" class=\"reset field\" name=\"cell-$i-$j\" value=\"O\" /></td>";
                }
                echo "</tr>";
            }
            ?>
            </table>
        </form>
    </article>
</section>
</body>
</html>