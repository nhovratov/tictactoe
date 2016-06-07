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
     * checks if the game has ended and echoes a success message
     * @return bool
     */
    public function isFinished()
    {
        $grid = $this->getBoard()->getGrid();
        $length = TicTacToe::DIMENSION;
        $message = function($shape) {
            echo "Player $shape has won!";
        };
        $checkLinear = function ($orientation) use ($grid, $length, $message) {
            for ($i = 0; $i < $length; $i++) {
                if ($orientation === "horizontal")
                    $shape = $grid[$i][0];
                else
                    $shape = $grid[0][$i];
                if (!empty($shape)) {
                    for ($j = 1; $j < $length; $j++) {
                        if ($orientation === "horizontal")
                            $compare = $grid[$i][$j];
                        else
                            $compare = $grid[$j][$i];
                        if ($compare === $shape)
                            continue;
                        else
                            continue 2;
                    }
                    $message($shape);
                    return true;
                }
            }
            return false;
        };
        $checkDiagonal = function ($orientation) use ($grid, $length, $message) {
            if ($orientation === "topleft")
                $shape = $grid[0][0];
            else
                $shape = $grid[$length-1][0];
            if (!empty($shape)) {
                for ($i = 1; $i < $length; $i++) {
                    if ($orientation === "topleft")
                        $compare = $grid[$i][$i];
                    else
                        $compare = $grid[($length-1)-$i][$i];
                    if ($compare === $shape)
                        continue;
                    else
                        return false;
                }
                $message($shape);
                return true;
            }
            return false;
        };
        $checkLinear("horizontal");
        $checkLinear("vertical");
        $checkDiagonal("topleft");
        $checkDiagonal("bottomleft");
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
