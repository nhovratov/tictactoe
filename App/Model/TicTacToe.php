<?php

class TicTacToe
{
    const DIMENSION = 3;
    
    public $board;
    public $player;
    private $currentShape;
    private $turn = 0;
    
    public function __construct()
    {
        $this->board = new Board(self::DIMENSION, self::DIMENSION);
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
        $params = explode("-", str_replace("cell-", "", key($_GET)));
        
        return array_map(function ($item) {
            return --$item;
        }, $params);
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
