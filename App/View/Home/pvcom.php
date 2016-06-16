<?php include_once "../App/View/Layout/header.inc.php" ?>
<section class="container bg-colorWhite">
    <h1 class="bg-colorESFLBlau">Hi, Flensburg developers!</h1>
    <p>Here comes the first game..</p>
    <button data-target="#infotext" class="btn btn-default btn-xs" data-toggle="collapse"><span class="glyphicon glyphicon-menu-up"></span> Infotext minimieren/maximieren.</button>
    <div id="infotext" class="jumbotron col-md-12 collapse in">
        <div class="col-md-3">
            <a title="By Thomas Steiner [GFDL (http://www.gnu.org/copyleft/fdl.html) or CC-BY-SA-3.0 (http://creativecommons.org/licenses/by-sa/3.0/)], via Wikimedia Commons" href="https://commons.wikimedia.org/wiki/File%3ATictactoe1.gif" target="_blank">
                <img alt="Tictactoe1" src="https://upload.wikimedia.org/wikipedia/commons/3/33/Tictactoe1.gif" class="img-responsive img-rounded"/></a>
        </div>
        <div class="col-md-9">
            <p>Tic-Tac-Toe (auch: Drei gewinnt, Kreis und Kreuz, Dodelschach) ist ein klassisches, einfaches Zweipersonen-Strategiespiel, dessen Geschichte sich bis ins 12. Jahrhundert v. Chr. zurückverfolgen lässt...<br/> <small><a href="https://en.wikipedia.org/wiki/Tic-tac-toe" target="_blank">(bei Wikipedia weiterlesen...)</a></small></p>
            <p class="bg-info">Du spielst das Kreuz und darfst beginnen. Klicke hierzu in das gewünschte Feld auf dem Spielfeld...</p>
        </div>
    </div>
    <article id="mainContent">
        <h2>Playing...</h2>
        <div class="row level1">
            <div class="col-md-offset-4 col-md-4">
        <h2>Spieler gegen Computer Level <?= $data['tictactoe']->getPlayer(1)->getLevel(); ?></h2>
        <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="hidden" name="tictactoe[controller]" value="TicTacToe" />
            <input type="hidden" name="tictactoe[action]" value="initiatePvp" />
            <input type="submit" class="btn" value="Wechsle zu Spieler gegen Spieler" />
        </form>
        <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="hidden" name="tictactoe[controller]" value="TicTacToe" />
            <input type="hidden" name="tictactoe[action]" value="initiatePvCom" />
            <select name="tictactoe[params]" class="form-control">
                <option value="1">Bot Level 1</option>
                <option value="2">Bot Level 2</option>
            </select>
            <input type="submit" value="Schwierigkeit auswählen" class="btn btn-default" />
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
