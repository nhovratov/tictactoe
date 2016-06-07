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
        $var = false;
        $length = TicTacToe::DIMENSION;
        $message = function($shape) {
            echo "Player $shape has won!";
        };
        //waagercht prüfen
        for ($row = 0; $row < $length; $row++) {
            $shape = $grid[$row][0];
            if (!empty($shape)) {
                for ($col = 1; $col < $length; $col++) {
                    if ($grid[$row][$col] === $shape) {
                        continue;
                    } else {
                        continue 2;
                    }
                }
                $message($shape);
                return true;
            }
        }
        //senkrecht prüfen
        for ($col = 0; $col < $length; $col++) {
            $shape = $grid[0][$col];
            if (!empty($shape)) {
                for ($row = 1; $row < $length; $row++) {
                    if ($grid[$row][$col] === $shape) {
                        continue;
                    } else {
                        continue 2;
                    }
                }
                $message($shape);
                return true;
            }
        }
        //diagonal oben link nach unten rechts
        $shape = $grid[0][0];
        for ($rowcol = 1; $rowcol < $length; $rowcol++) {
            if (!empty($shape)) {
                if ($grid[$rowcol][$rowcol] === $shape) {
                    $var = true;
                } else {
                    $var = false;
                    break;
                }
            }
        }
        if ($var) {
            $message($shape);
            return true;
        }
        //diagonal unten links nach oben rechts
        $shape = $grid[$length-1][0];
        for ($i = 1; $i < $length; $i++) {
            if (!empty($shape)) {
                if ($grid[($length-1)-$i][$i] === $shape) {
                    $var = true;
                } else {
                    $var = false;
                    break;
                }
            }
        }
        if ($var) {
            $message($shape);
            return true;
        }
        return false;
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
