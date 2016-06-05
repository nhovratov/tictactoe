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
        $this->currentShape = $this->player[0]->getShape();
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
