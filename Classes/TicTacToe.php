<?php

class TicTacToe
{
    public $board;
    public $player;
    
    public function __construct($boardDimension)
    {
        $this->board = new Board($boardDimension, $boardDimension);
        $this->player = [new Player("Player1", "X"), new Bot("Computer", "O")];
    }


    /**
     * TODO Algorithmus erstellen, um das Spielende zu erkennen
     */
    public function isFinished()
    {
        
    }
    
    public function getDimension()
    {
        return $this->board->getRows();
    }
    
}
