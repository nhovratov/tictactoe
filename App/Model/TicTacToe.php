<?php

class TicTacToe
{
    const DIMENSION = 3;

    /** @var Board $board  */
    protected $board = null;

    /** @var array $player */
    protected $players = [];

    /** @var string $currentShape */
    protected $currentShape = '';

    /** @var int $turn */
    protected $turn = 0;

    /** @var array $shapes */
    protected $shapes = ["X", "O"];

    /**
     * @param $mode
     */
    public function __construct($mode)
    {
        $this->board = new Board(self::DIMENSION, self::DIMENSION);
        if ($mode === "pvp")
            $this->players = [new Player("Player 1", $this->shapes[0]), new Player("Player 2", $this->shapes[1])];
        else
            $this->players = [new Player("Player 1", $this->shapes[0]), new Bot("TicTacToe-Bot", $this->shapes[1], 1)];
        $this->currentShape = $this->players[0]->getShape();
        $this->turn = 0;
    }

    private function checkLinear($grid, $message)
    {
        $length = TicTacToe::DIMENSION;
        for ($row = 0; $row < $length; $row++) {
            $shape = $grid[$row][0];
            if (empty($shape)) continue;

            for ($column = 1; $column < $length; $column++) {
                    $compare = $grid[$row][$column];
                if ($compare === $shape)
                    continue;
                else
                    continue 2;
            }
            //If the loop goes through all fields are the same and theres a winner
            return $message($shape);
        }
        return false;
    }

    /**
     * checks if the game has ended and returns a message
     * @return mixed
     */
    public function isFinished()
    {
        $grid = $this->getBoard()->getGrid();
        $length = TicTacToe::DIMENSION;
        $findPlayerIdByShape = function ($shape) {
            return array_search($shape, $this->shapes);
        };
        $message = function($shape) use ($findPlayerIdByShape) {
            $winner = $this->players[$findPlayerIdByShape($shape)];
            $name = $winner->getName();
            if (get_class($winner) === "Bot")
                return "<div class='alert alert-danger'>$name ($shape) has won!</div>";
            else
                return "<div class='alert alert-success'>$name ($shape) has won!</div>";
        };
        $tied = "<div class='alert alert-info'>It's a tight!</div>";
        $checkLinear = function ($orientation) use ($grid, $length, $message) {
            for ($i = 0; $i < $length; $i++) {
                if ($orientation === "horizontal")
                    $shape = $grid[$i][0];
                else
                    $shape = $grid[0][$i];
                if (empty($shape)) continue;

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
                return $message($shape);
            }
            return false;
        };
        $checkDiagonal = function ($orientation) use ($grid, $length, $message) {
            if ($orientation === "topleft")
                $shape = $grid[0][0];
            else
                $shape = $grid[$length-1][0];
            if (empty($shape)) return false;

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
            return $message($shape);
        };

        $result = $this->checkLinear($grid, $message);
        if ($result) return $result;

        $result = $this->checkLinear($this->getBoard()->flipToRight(), $message);
        if ($result) return $result;

        $result = $checkDiagonal("topleft");
        if ($result) return $result;

        $result = $checkDiagonal("bottomleft");
        if ($result) return $result;
        else if ($this->turn === ($length * $length))
            return $tied;
        else
            return false;
    }

    public function increaseTurn()
    {
        $this->turn++;
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

    /**
     * @return Board
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * @param $x
     * @return Player
     */
    public function getPlayer($x)
    {
        return $this->players[$x];
    }

    public function getPlayers()
    {
        return $this->players;
    }

}
