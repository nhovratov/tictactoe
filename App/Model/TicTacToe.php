<?php

class TicTacToe
{
    const DIMENSION = 3;
    
    /** @var Board $board  */
    protected $board = null;
    
    /** @var Player $player */
    protected $player = null;
    
    /** @var Bot $bot */
    protected $bot = null;
    
    /** @var string $currentShape */
    protected $currentShape = '';
    
    /** @var string $turn */
    protected $turn = '';
    
    public function __construct()
    {
        $this->board = new Board(self::DIMENSION, self::DIMENSION);
        $this->player = new Player("Player", "X");
        $this->bot = new Bot("Computer", "O");
        $this->currentShape = $this->player->getShape();
        $this->turn = 'player';
    }

    /**
     * TODO Algorithmus erstellen, um das Spielende zu erkennen
     */
    public function isFinished()
    {

    }
    
    /**
     * @return string
     */
    public function getCurrentShape()
    {
        return $this->currentShape;
    }

    /**
     * @param string $currentShape
     */
    public function setCurrentShape($currentShape)
    {
        $this->currentShape = $currentShape;
    }

    /**
     * @return string
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * @param string $turn
     */
    public function setTurn($turn)
    {
        $this->turn = $turn;
    }

    /**
     * @return Board
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @return Bot
     */
    public function getBot()
    {
        return $this->bot;
    }

}
