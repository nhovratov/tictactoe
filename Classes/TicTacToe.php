<?php

class TicTacToe
{
    public $board;
    public $player;
    private $currentShape;
    private $turn = 0;
    
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
        $this->currentShape = $this->player[$this->turn]->getShape();
        $_SESSION['game'] = serialize($this);
    }
    
    public function getParameters()
    {
        return $coordinates = explode("-", str_replace("cell-", "", key($_GET)));
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

    /**
     * @return int
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * @param int $turn
     */
    public function setTurn($turn)
    {
        $this->turn = $turn;
    }

}
