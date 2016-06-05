<?php include_once "../App/View/Layout/header.inc.php" ?>

<section>
    <h1>Tic-Tac-Toe</h1>
    <article id="mainContent">
        <h2>Your free browsergame!</h2>
        <p>Type your game instructions here...</p>
        <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="hidden" name="tictactoe[controller]" value="home">
            <input type="hidden" name="tictactoe[action]" value="maketurn">
            <table class="tic">

<?php
for ($i = 1; $i <= $data['tictactoe']->getDimension(); $i++) {
    echo "<tr>";
    for ($j = 1; $j <= $data['tictactoe']->getDimension(); $j++) {
        $value = $data['tictactoe']->board->getGrid()[$i - 1][$j - 1];
        if (!empty($value)) {
            echo "<td><input type='submit' class='reset field color$value' name='cell-$i-$j\' value='$value' /></td>";
        } else {
            echo "<td><input type='submit' class='reset field' name='tictactoe[params][cell-$i-$j]' value='{$data['tictactoe']->getCurrentShape()}' /></td>";
        }
    }
    echo "</tr>";
}
?>

            </table>
        </form>
    </article>
</section>

<?php include_once "../App/View/Layout/footer.inc.php" ?>
