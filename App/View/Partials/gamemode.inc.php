<?php if($data['tictactoe']->getTurn() == 0 || $data['message']) :?>
<form method="get" action="<?= $_SERVER['PHP_SELF'] ?>" class="gamemode">
    <input type="hidden" name="tictactoe[controller]" value="TicTacToe"/>
    <fieldset>
        <select name="tictactoe[action]" class="form-control" id="selectMode">
            <option value="initiatePvp">Spieler vs. Spieler</option>
            <option value="initiatePvCom">Spieler vs. Com</option>
        </select>
    </fieldset>
    <fieldset id="difficulty">
        <label for="lvl">Computer Intelligenz auswählen</label>
        <select name="tictactoe[params]" class="form-control" id="lvl">
            <option value="1">Bot Level 1</option>
            <option value="2">Bot Level 2</option>
        </select>
    </fieldset>
    <input type="submit" value="Los!" class="btn btn-default"/>
</form>
<?php endif; ?>
