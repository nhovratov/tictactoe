<?php include_once "../App/View/Layout/header.inc.php" ?>
<section>
    <h1>Tic-Tac-Toe</h1>
    <article id="mainContent">
        <h2>Viel Spaß beim Spiel!</h2>
        <p>Wähle ein Feld. Wer zuerst 3 Formen in der Reihe hat gewinnt.</p>
        <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="hidden" name="tictactoe[controller]" value="TicTacToe" />
            <input type="hidden" name="tictactoe[action]" value="makeMove" />
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
        } else {
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
        <input type="hidden" name="tictactoe[action]" value="resetBoard" />
        <input type="submit" value="reset" />
    </form>
</section>
<?php include_once "../App/View/Layout/footer.inc.php" ?>
