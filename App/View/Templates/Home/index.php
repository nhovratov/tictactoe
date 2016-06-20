<?php include_once "../App/View/Layouts/header.inc.php" ?>
<section class="container bg-colorWhite">
    <h1 class="bg-colorESFLBlau row salute">Hi, Flensburg developers!</h1>
    <p>Here comes the first game..</p>
    <?php $render->partial("infobox") ?>
    <article id="mainContent">
        <?php if ($data['gamemode'] == "playerVsCom") : ?>
            <h2>Spieler gegen Computer Level <?= $data['tictactoe']->getPlayer(1)->getLevel(); ?></h2>
        <?php endif; ?>
        <?php if ($data['gamemode'] == "playerVsPlayer") : ?>
            <h2>Spieler gegen Spieler</h2>
        <?php endif; ?>
        <?php $render->partial("gamemode", $data) ?>
        <?php $render->partial("status", $data) ?>
        <div class="row level1">
            <div class="col-md-offset-4 col-md-4">
                <?php $render->partial("tictactoe-board", $data, ['action' => $data['gamemode']]); ?>
            </div>
        </div>
    </article>
</section>
<?php include_once "../App/View/Layouts/footer.inc.php" ?>
