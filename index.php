<?php
session_start();

require_once "Classes/Board.php";
require_once "Classes/Player.php";
require_once "Classes/Bot.php";
require_once "Classes/TicTacToe.php";

if (empty($_GET)) {
    $tictactoe = new TicTacToe(3);
    $tictactoe->initialiseGame();

} else {
    $tictactoe = unserialize($_SESSION['game']);
    $lastturn = $_SESSION['turn'];
    $turn = $lastturn === 0 ? 1: 0;
    $tictactoe->setCurrentShape($tictactoe->player[$turn]->getShape());
    $setCell = str_replace("cell-", "", key($_GET));
    $coordinates = explode("-", $setCell);

    $shape = current($_GET);
    $tictactoe->board->makeMove($coordinates[0]-1, $coordinates[1]-1, $shape);

    $_SESSION['game'] = serialize($tictactoe);
    $_SESSION['turn'] = $turn;
}

echo "<pre>";
//var_dump($tictactoe);
echo "</pre>";
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
                    $value = $tictactoe->board->getGrid()[$i-1][$j-1];
                    if (!empty($value)) {
                        echo "<td><input type=\"submit\" class=\"reset field color$value\" name=\"cell-$i-$j\" value=\"$value\" /></td>";
                    } else {
                        echo "<td><input type=\"submit\" class=\"reset field\" name=\"cell-$i-$j\" value=\"{$tictactoe->getCurrentShape()}\" /></td>";
                    }
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