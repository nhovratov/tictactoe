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
    public function index()
    {
        $this->tictactoe = $this->model('TicTacToe');
        $_SESSION['game'] = serialize($this->tictactoe);

        $this->view('home/index', ['tictactoe' => $this->tictactoe]);
    }

    /**
     * executes a move
     *
     * @param $move
     * @return void
     */
    public function makeMove($move)
    {
        $this->tictactoe = unserialize($_SESSION['game']);
        //Set the chosen field
        $coordinates = $this->tictactoe->getBoard()->getParameters($move);
        $this->tictactoe->getBoard()->setGrid($coordinates[0], $coordinates[1], $this->tictactoe->getCurrentShape());
        //check status
        $message = $this->tictactoe->isFinished();
        //next turn
        $this->tictactoe->setTurn($this->tictactoe->getTurn() === 'player' ? 'bot' : 'player');
        
        if ($this->tictactoe->getTurn() === 'player')
            $this->tictactoe->setCurrentShape($this->tictactoe->getPlayer()->getShape());
        else
            $this->tictactoe->setCurrentShape($this->tictactoe->getBot()->getShape());
        
        $_SESSION['game'] = serialize($this->tictactoe);

        $this->view('home/index', ['tictactoe' => $this->tictactoe, 'message' => $message]);
    }

    public function resetBoard()
    {
        $this->tictactoe = unserialize($_SESSION['game']);
        $this->tictactoe->getBoard()->resetGrid(TicTacToe::DIMENSION, TicTacToe::DIMENSION);
        $this->tictactoe->setCurrentShape($this->tictactoe->getPlayer()->getShape());
        $this->tictactoe->setTurn('player');
        $_SESSION['game'] = serialize($this->tictactoe);
        $this->view('home/index', ['tictactoe' => $this->tictactoe]);
    }
    
}
