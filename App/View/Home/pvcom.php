<?php include_once "../App/View/Layout/header.inc.php" ?>
<section class="container">
    <h1>Tic-Tac-Toe</h1>
    <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
        <input type="hidden" name="tictactoe[controller]" value="TicTacToe" />
        <input type="hidden" name="tictactoe[action]" value="initiatePvp" />
        <input type="submit" class="btn" value="Wechsle zu Spieler gegen Spieler" />
    </form>
    <article id="mainContent">
        <h2>Spieler gegen Computer<span class="glyphicons glyphicons-robot"></span></h2>
        <p>Wähle ein Feld. Wer zuerst 3 Formen in der Reihe hat gewinnt.</p>
<?php
if (!empty($data['message'])):
    echo "{$data['message']}";
endif;
?>
        <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="hidden" name="tictactoe[controller]" value="TicTacToe" />
            <input type="hidden" name="tictactoe[action]" value="playerVsCom" />
            <table class="tic">
<?php
for ($i = 1; $i <= $data['tictactoe']->getBoard()->getRows(); $i++) {
    echo "<tr>";
    for ($j = 1; $j <= $data['tictactoe']->getBoard()->getColumns(); $j++) {
        $value = $data['tictactoe']->getBoard()->getGrid()[$i - 1][$j - 1];
        if (!empty($value)) {
            echo "<td><input
                    disabled='disabled'
                    type='submit'
                    class='reset field color$value'
                    name='tictactoe[params][cell-$i-$j]' 
                    value='$value' 
                /></td>";
        } elseif (!empty($data['message'])) {
            echo "<td><input 
                    disabled='disabled'
                    type='submit'
                    class='reset field'
                    name='tictactoe[params][cell-$i-$j]'
                    value=''
                 /></td>";
        }
        else {
            echo "<td><input 
                    type='submit' 
                    class='reset field' 
                    name='tictactoe[params][cell-$i-$j]' 
                    value='{$data['tictactoe']->getCurrentShape()}'
                 /></td>";
        }
    }
    echo "</tr>";
}
?>
            </table>
        </form>
    </article>
    <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
        <input type="hidden" name="tictactoe[controller]" value="TicTacToe" />
        <input type="hidden" name="tictactoe[action]" value="initiatePvCom" />
        <input type="submit" value="New Game" class="btn btn-primary" />
        <span class="glyphicon glyphicon-repeat"></span>
    </form>
</section>
<?php include_once "../App/View/Layout/footer.inc.php" ?>
