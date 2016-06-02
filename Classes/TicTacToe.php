<?php

class TicTacToe
{
    private $board;
    private $player;
    
    public function __construct($boardDimension)
    {
        $this->board = new Board($boardDimension, $boardDimension);
        $this->player = [new Player("Player1", "X"), new Bot("Computer", "O")];
    }
    
    public function isFinished()
    {
        
    }
    
    public function getDimension()
    {
        return $this->board->getRows();
    }
}
