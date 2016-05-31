<?php

class TicTacToe
{
    private $board;
    private $player;
    
    public function __construct(Board $board, array $player)
    {
        $this->board = $board;
        $this->player = $player;
    }
    
    public function isFinished()
    {
        
    }
}