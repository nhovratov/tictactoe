<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tic-Tac-Toe. This is the title. It is displayed in the titlebar of the window in most browsers.</title>
    <meta name="description" content="Tic-Tac-Toe-Game. Here is a short description for the page. This text is displayed e. g. in search engine result listings.">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="Css/bootstrap.css">
    <link rel="stylesheet" href="Css/bootstrap-theme.css">
    <link rel="stylesheet" href="Css/style.css" />
    <link rel="stylesheet" href="Css/add.css" />
    <!-- The following css-definitions are used just for showing you where the components of this page are placed. Feel free to delete the whole style-tag and to remove the classes in the html elements. -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="bg-colorESFLGruen">
<header class="container">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="img/esfllogo.png" class="navbar-logo" alt="ESFL-Logo"/></a><p class="navbar-text">Tic-Tac-Toe</p>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php if ($data['gamemode'] === 'playerVsPlayer'): ?>
                        <li><a href="index.php">Start new</a></li>
                    <?php endif; ?>
                    <?php if ($data['gamemode'] === 'playerVsCom'): ?>
                        <li>
                        <form action="<?=$_SERVER['PHP_SELF'];?>" method="get">
                            <input type="hidden" name="tictactoe[controller]" value="TicTacToe">
                            <input type="hidden" name="tictactoe[action]" value="<?=$data['reset']?>">
                            <input type="hidden" name="tictactoe[params]" value="<?= $data['tictactoe']->getPlayer(1)->getLevel(); ?>">
                        </form>
                            <a href="javascript:void(0);" onclick="$(this).prev('form').submit();">Start new</a>
                        </li>
                    <?php endif; ?>
                    <li><a href="https://de.wikipedia.org/wiki/Tic-Tac-Toe" target="_blank">Über Tic-Tac-Toe</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>