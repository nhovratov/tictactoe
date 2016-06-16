<div class="statusbar bg-colorESFLRot row">
    <h2>
        <?php
        if (!empty($data['message'])) {
            echo $data['message'];
        } elseif ($data['tictactoe']->getTurn() == 0) {
            echo "The game is about to begin...";
        } else {
            echo "Playing...";
        }
        ?>
    </h2>
</div>
