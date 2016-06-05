<?php

class Home extends Controller
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
    public function makeTurn($move)
    {
        $this->tictactoe = unserialize($_SESSION['game']);
        $coordinates = $this->getParameters($move);
        $this->tictactoe->board->setGrid($coordinates[0], $coordinates[1], $this->tictactoe->getCurrentShape());
        $this->tictactoe->setTurn($this->tictactoe->getTurn() === 0 ? 1: 0);
        $this->tictactoe->setCurrentShape($this->tictactoe->player[$this->tictactoe->getTurn()]->getShape());
        $_SESSION['game'] = serialize($this->tictactoe);

        $this->view('home/index', ['tictactoe' => $this->tictactoe]);
    }

    /**
     * fetches the chosen grid coordinates and return them as array
     *
     * @param array $params
     * @return array
     */
    private function getParameters($params)
    {
        $params = explode("-", str_replace("cell-", "", key($params)));

        return array_map(function ($item) {
            return --$item;
        }, $params);
    }
}
