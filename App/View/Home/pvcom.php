<?php include_once "../App/View/Layout/header.inc.php" ?>
<section class="container bg-colorWhite">
    <h1 class="bg-colorESFLBlau row salute">Hi, Flensburg developers!</h1>
    <p>Here comes the first game..</p>
<?php include_once "../App/View/Partials/infobox.inc.php" ?>
    <article id="mainContent">
        <h2>Playing...</h2>
        <div class="row level1">
            <div class="col-md-offset-4 col-md-4">
        <h2>Spieler gegen Computer Level <?= $data['tictactoe']->getPlayer(1)->getLevel(); ?></h2>
        <form method="get" action="<?= $_SERVER['PHP_SELF']?>">
            <input type="hidden" name="tictactoe[controller]" value="TicTacToe" />
            <select name="tictactoe[action]" class="form-control" id="selectMode">
                <option value="initiatePvp">Spieler vs. Spieler</option>
                <option value="initiatePvCom">Spieler vs. Com</option>
            </select>
            <fieldset id="difficulty">
                <label for="lvl">Computer Intelligenz auswählen</label>
                <select name="tictactoe[params]" class="form-control" id="lvl">
                    <option value="1">Bot Level 1</option>
                    <option value="2">Bot Level 2</option>
                </select>
            </fieldset>
            <input type="submit" value="Los!" class="btn btn-default" />
        </form>
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
            <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
                <input type="hidden" name="tictactoe[controller]" value="TicTacToe" />
                <input type="hidden" name="tictactoe[action]" value="initiatePvCom" />
                <input type="hidden" name="tictactoe[params]" value="<?= $data['tictactoe']->getPlayer(1)->getLevel(); ?>" />
                <input type="submit" value="New Game" class="btn btn-primary" />
                <span class="glyphicon glyphicon-repeat"></span>
            </form>
            </div>
        </div>

    </article>

</section>
<?php include_once "../App/View/Layout/footer.inc.php" ?>
