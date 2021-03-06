<div class="statusbar bg-colorESFLRot row">
    <h2>
        <?php
        if (!empty($data['message'])) {
            if ($data['message'] === 'tight') {
                echo "It's a tight!";
            } elseif ($data['message'] === 'error') {
                echo "Etwas ist schief gelaufen :/";
            } else {
                echo "{$data['message']['name']} &bdquo;{$data['message']['shape']}&ldquo; has won!";
            }
        } elseif ($data['tictactoe']->getTurn() == 0) {
            if ($data['gamemode'] == "playerVsCom") : ?>
                <h2>Spieler gegen Computer Level <?= $data['tictactoe']->getPlayer(1)->getLevel(); ?></h2>
            <?php endif; ?>
            <?php if ($data['gamemode'] == "playerVsPlayer") : ?>
                <h2>Spieler gegen Spieler</h2>
            <?php endif;
        } else {
            echo "Playing...";
        }
        ?>
    </h2>
</div>
