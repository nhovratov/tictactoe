<form method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
    <input type="hidden" name="tictactoe[controller]" value="TicTacToe"/>
    <input type="hidden" name="tictactoe[action]" value="<?= $args['action'] ?>"/>
    <table class="tic">
        <?php
        for ($i = 1; $i <= $data['tictactoe']->getBoard()->getRows(); $i++) {
            echo "<tr>";
            for ($j = 1; $j <= TicTacToe::DIMENSION; $j++) {
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
