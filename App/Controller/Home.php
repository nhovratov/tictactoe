<?php

class Home extends Controller
{
    protected $tictactoe;

    public function __construct()
    {
        $this->tictactoe = $this->model('TicTacToe');
    }

    public function index()
    {
        $_SESSION['game'] = serialize($this->tictactoe);
        $this->view('home/index', ['tictactoe' => $this->tictactoe]);
    }

}
