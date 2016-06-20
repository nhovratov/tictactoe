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
            $this->players = [new Player("Player 1", $this->shapes[0]), new Bot("TicTacToe-Bot", $this->shapes[1], 2)];
        $this->currentShape = $this->players[0]->getShape();
        $this->turn = 0;
    }

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
            return $this->getVictoryMessage($shape);
        }
        return false;
    }

    /**
     * checks if the game has ended and returns a message
     * @return mixed
     */
    public function isFinished()
    {
        $result = $this->checkLinear($this->getBoard()->getGrid());
        if ($result) return $result;

        $result = $this->checkLinear($this->getBoard()->flipToRight());
        if ($result) return $result;

        $result = $this->checkLinear($this->getBoard()->getDiagonals());
        if ($result) return $result;

        if ($this->turn === (TicTacToe::DIMENSION * TicTacToe::DIMENSION))
            return $this->getTiedMessage();
        else
            return false;
    }

    /**
     * @param $shape
     * @return string
     * TODO Texte in den View verlagern, nur Namen, Form und message type übergeben
     */
    public function getVictoryMessage($shape)
    {
        $winner = $this->players[$this->findPlayerIdByShape($shape)];
        $name = $winner->getName();

        if (get_class($winner) === "Bot") {
            return "$name \"$shape\" has won!";
        } else {
            return "$name \"$shape\" has won!";
        }
    }

    public function getTiedMessage()
    {
        return "It's a tight!";
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

}
