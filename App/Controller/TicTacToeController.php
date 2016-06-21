<?php

class TicTacToeController extends Controller
{
    /**
     * @var TicTacToe $tictactoe
     */
    protected $tictactoe;

    protected function returnToReferrer($resetAction)
    {
        $_SESSION['game'] = serialize($this->tictactoe);
        $this->view('home/index', ['tictactoe' => $this->tictactoe, 'message' => 'error', 'gamemode' => $_GET['tictactoe']['action'], 'reset' => $resetAction]);
    }

    /**
     * default action instatiates a new TicTacTow object
     *
     * @return void
     */
    public function initiatePvP()
    {
        $this->tictactoe = $this->model('TicTacToe', 'pvp');
        $_SESSION['game'] = serialize($this->tictactoe);
        $this->view('home/index', ['tictactoe' => $this->tictactoe, 'gamemode' => 'playerVsPlayer', 'reset' => 'initiatePvP']);
    }

    public function initiatePvCom($level = 1)
    {
        $this->tictactoe = $this->model('TicTacToe', 'pvcom');
        $this->tictactoe->getPlayer(1)->setLevel($level);
        $_SESSION['game'] = serialize($this->tictactoe);
        $this->view('home/index', ['tictactoe' => $this->tictactoe, 'gamemode' => 'playerVsCom', 'reset' => 'initiatePvCom']);
    }

    /**
     * @param $move
     * @return bool
     */
    public function playerVsPlayer($move)
    {
        $this->tictactoe = unserialize($_SESSION['game']);

        if (!$coordinates = $this->tictactoe->getBoard()->getParameters($move)) {
            $this->returnToReferrer('initiatePvp');
            return false;
        }
        //Spieler 1 fängt immer an.
        if ($this->tictactoe->getTurn() % 2 == 0 || $this->tictactoe->getTurn() == 0) {
            if (!$this->tictactoe->getPlayer(0)->makeTurn($this->tictactoe->getBoard(), $coordinates)) {
                $this->returnToReferrer('initiatePvp');
                return false;
            };
            $this->tictactoe->setCurrentShape($this->tictactoe->getPlayer(1)->getShape());
        }
        //Spielzug Spieler 2
        else {
            if (!$this->tictactoe->getPlayer(1)->makeTurn($this->tictactoe->getBoard(), $coordinates)) {
                $this->returnToReferrer('initiatePvp');
                return false;
            };
            $this->tictactoe->setCurrentShape($this->tictactoe->getPlayer(0)->getShape());
        }
        $this->tictactoe->increaseTurn();
        $message = $this->tictactoe->isFinished();

        $_SESSION['game'] = serialize($this->tictactoe);

        $this->view('home/index', ['tictactoe' => $this->tictactoe, 'message' => $message, 'gamemode' => 'playerVsPlayer', 'reset' => 'initiatePvP']);
        return true;
    }
    /**
     * executes a move
     *
     * @param $move
     * @return bool
     */
    public function playerVsCom($move)
    {
        $this->tictactoe = unserialize($_SESSION['game']);
        //Player move
        if (!$coordinates = $this->tictactoe->getBoard()->getParameters($move)) {
            $this->returnToReferrer('initiatePvCom');
            return false;
        }
        if (!$this->tictactoe->getPlayer(0)->makeTurn($this->tictactoe->getBoard(), $coordinates)) {
            $this->returnToReferrer('initiatePvCom');
            return false;
        };
        $this->tictactoe->increaseTurn();
        $message = $this->tictactoe->isFinished();

        if (empty($message)) { //Check whether the game has aleready ended, so the computer dont need to make a move
            //Computer move
            $this->tictactoe->getPlayer(1)->makeAutoTurn($this->tictactoe->getBoard());
            $message = $this->tictactoe->isFinished();
            $this->tictactoe->increaseTurn();
        }

        $_SESSION['game'] = serialize($this->tictactoe);

        $this->view('home/index', ['tictactoe' => $this->tictactoe, 'message' => $message, 'gamemode' => 'playerVsCom', 'reset' => 'initiatePvCom']);
        return true;
    }



}
