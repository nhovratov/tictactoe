<?php
session_start();

require_once "Classes/Board.php";
require_once "Classes/Player.php";
require_once "Classes/Bot.php";
require_once "Classes/TicTacToe.php";
/**
 * @param TicTacToe $tictactoe
 * @return object
 */
function startNewGame(TicTacToe $tictactoe)
{
    $tictactoe->initialiseGame();
    return $tictactoe;
}

if (empty($_GET)) {
    $tictactoe = startNewGame(new TicTacToe);
} else {
    // Get the object from the current session
    $tictactoe = unserialize($_SESSION['game']);
    // Execute the move
    $coordinates = $tictactoe->getParameters();
    $tictactoe->board->setGrid($coordinates[0], $coordinates[1], $tictactoe->getCurrentShape());
    // Prepare next move/turn
    $tictactoe->setTurn($tictactoe->getTurn() === 0 ? 1: 0);
    $tictactoe->setCurrentShape($tictactoe->player[$tictactoe->getTurn()]->getShape());
    // Store the object in a session
    $_SESSION['game'] = serialize($tictactoe);
}

echo "<pre>";
//var_dump($coordinates);
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