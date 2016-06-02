<?php

class TicTacToe
{
    public $board;
    public $player;
    private $currentShape;
    
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
    
    public function initialiseGame()
    {
        $turn = 0;
        $this->currentShape = $this->player[$turn]->getShape();
        $_SESSION['game'] = serialize($this);
        $_SESSION['turn'] = $turn;
    }

    public function  getCurrentShape()
    {
        return $this->currentShape;
    }

    /**
     * @param mixed $currentShape
     */
    public function setCurrentShape($currentShape)
    {
        $this->currentShape = $currentShape;
    }

}
