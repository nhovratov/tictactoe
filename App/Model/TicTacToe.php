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
    
    /** @var bool $activeGame */
    protected $activeGame = true;

    /**
     * @param $mode
     */
    public function __construct($mode)
    {
        $this->board = new Board(self::DIMENSION, self::DIMENSION);
        if ($mode === "pvp")
            $this->players = [new Player("Player 1", $this->shapes[0]), new Player("Player 2", $this->shapes[1])];
        else
            $this->players = [new Player("Player 1", $this->shapes[0]), new Bot("TicTacToe-Bot", $this->shapes[1], 2)];
        $this->currentShape = $this->players[0]->getShape();
        $this->turn = 0;
    }

    /**
     * @param $grid
     * @return bool|string
     */
    private function checkLinear($grid)
    {
        $rowCount = count($grid);
        $colCount = TicTacToe::DIMENSION;
        for ($row = 0; $row < $rowCount; $row++) {
            $shape = $grid[$row][0];
            if (empty($shape)) continue;

            for ($col = 1; $col < $colCount; $col++) {
                    $compare = $grid[$row][$col];
                if ($compare === $shape)
                    continue;
                else
                    continue 2;
            }
            //If the loop goes through all fields are the same and theres a winner
            return $this->getMessage($shape);
        }
        return false;
    }

    /**
     * checks if the game has ended and returns a message
     * @return mixed
     */
    protected function isFinished()
    {
        $result = $this->checkLinear($this->getBoard()->getGrid());
        if ($result) return $result;

        $result = $this->checkLinear($this->getBoard()->flipToRight());
        if ($result) return $result;

        $result = $this->checkLinear($this->getBoard()->getDiagonals());
        if ($result) return $result;

        if ($this->turn === (TicTacToe::DIMENSION * TicTacToe::DIMENSION))
            return $this->getMessage();
        else
            return false;
    }
    
    public function checkGameStatus()
    {
        $result = $this->isFinished();
        
        if ($result) {
            $this->activeGame = false;
        }

        return $result;
    }

    /**
     * @param $shape
     * @return string
     */
    public function getMessage($shape = null)
    {
        if ($shape) {
            $winner = $this->players[$this->findPlayerIdByShape($shape)];
            $name = $winner->getName();
            return ['name' => $name, 'shape' => $shape];
        }
        
        return 'tight';
    }

    /**
     * Finds the arrayposition of a player
     * @param $shape
     * @return mixed
     */
    public function findPlayerIdByShape($shape)
    {
        return array_search($shape, $this->shapes);
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

    /**
     * @return boolean
     */
    public function isActiveGame()
    {
        return $this->activeGame;
    }

    /**
     * @param boolean $activeGame
     */
    public function setActiveGame($activeGame)
    {
        $this->activeGame = $activeGame;
    }
}
