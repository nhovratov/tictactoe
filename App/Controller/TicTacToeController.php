<?php

class TicTacToeController extends Controller
{
    /**
     * @var TicTacToe $tictactoe
     */
    protected $tictactoe;

    /**
     * default action instatiates a new TicTacTow object
     *
     * @return void
     */
    public function initiatePvP()
    {
        $this->tictactoe = $this->model('TicTacToe');
        $_SESSION['game'] = serialize($this->tictactoe);
        $this->view('home/pvp', ['tictactoe' => $this->tictactoe]);
    }

    public function initiatePvCom()
    {
        $this->tictactoe = $this->model('TicTacToe');
        $_SESSION['game'] = serialize($this->tictactoe);
        $this->view('home/pvcom', ['tictactoe' => $this->tictactoe]);
    }

    /**
     * executes a move
     *
     * @param $move
     * @return void
     */
    public function playerVsCom($move)
    {
        $this->tictactoe = unserialize($_SESSION['game']);
        //Player move
        $coordinates = $this->tictactoe->getBoard()->getParameters($move);
        $this->tictactoe->getPlayer()->makeTurn($this->tictactoe->getBoard(), $coordinates);
        $this->tictactoe->increaseTurn();
        $message = $this->tictactoe->isFinished();

        if (empty($message)) {
            //Computer move
            $this->tictactoe->getBot()->makeAutoTurn($this->tictactoe->getBoard());
            $message = $this->tictactoe->isFinished();
            $this->tictactoe->increaseTurn();
        }

        $_SESSION['game'] = serialize($this->tictactoe);

        $this->view('home/pvcom', ['tictactoe' => $this->tictactoe, 'message' => $message]);
    }


    public function playerVsPlayer($move)
    {
        $this->tictactoe = unserialize($_SESSION['game']);
        //Player move
        $coordinates = $this->tictactoe->getBoard()->getParameters($move);
        if ($this->tictactoe->getTurn() % 2 == 0 || $this->tictactoe->getTurn() == 0) {
            $this->tictactoe->getPlayer()->makeTurn($this->tictactoe->getBoard(), $coordinates);
            $this->tictactoe->setCurrentShape($this->tictactoe->getBot()->getShape());
        }
        else {
            $this->tictactoe->getBot()->makeTurn($this->tictactoe->getBoard(), $coordinates);
            $this->tictactoe->setCurrentShape($this->tictactoe->getPlayer()->getShape());
        }
        $this->tictactoe->increaseTurn();
        $message = $this->tictactoe->isFinished();

        $_SESSION['game'] = serialize($this->tictactoe);

        $this->view('home/pvp', ['tictactoe' => $this->tictactoe, 'message' => $message]);
    }
    
}
