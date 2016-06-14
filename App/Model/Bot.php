<?php

class Bot extends Player
{
    protected $level = 0;
    
    public function __construct($name, $shape, $level)
    {
        parent::__construct($name, $shape);
        $this->level = $level;
    }

    /**
     * Checks what lvl the Bot has and makes move accordingly
     * @param Board $board
     */
    public function makeAutoTurn(Board $board)
    {
        if ($this->level === 1)
            $this->makeRandomTurn($board);
        elseif ($this->level == 2)
            $this->makeFillTurn($board);
    }

    private function generateRandomCoords()
    {
        $x = rand(0, TicTacToe::DIMENSION -1);
        $y = rand(0, TicTacToe::DIMENSION -1);
        return [$x, $y];
    }

    private function getFreeRandomCoords(Board $board)
    {
        do {
            $coords = $this->generateRandomCoords();
        } while (!empty($board->getGrid()[$coords[0]][$coords[1]]));

        return $coords;
    }
    /**
     * @param Board $board
     */
    public function makeRandomTurn(Board $board)
    {
        $coords = $this->getFreeRandomCoords($board);
        $board->setGrid($coords[0], $coords[1], $this->shape);
    }

    public function scanForGap(Board $board, $orientation)
    {
        if ($orientation === "horizontal")
            $grid = $board->getGrid();
        elseif ($orientation === "vertical")
            $grid = $board->flipToRight();
        else
            $grid = $board->getDiagonals();

        $rowCount = count($grid);
        for ($row = 0; $row < $rowCount; $row++) {
            //the Bots shape is not in the array
            if (!in_array($this->getShape(), $grid[$row]))
                continue;

            //there is no free empty space
            if (!in_array('', $grid[$row]))
                continue;

            $values = array_count_values($grid[$row]);
            $countBotShape = $values[$this->getShape()];

            //there must be enough shapes
            if ($countBotShape < TicTacToe::DIMENSION - 1)
                continue;

            /*if there is only one empty space left and everything else is the Bots shape, gg!
            get the free spot */
            $freeSpot = array_search('', $grid[$row]);

            if ($orientation === "horizontal")
                return [$row, $freeSpot];
            elseif ($orientation === "vertical")
                return [$freeSpot, $row];
            else
                return $board->decodeDiagonalCoordinate($row, $freeSpot);
        }

        return false;
    }

    /**
     * Checks if there is a gap which leads to a win when filled
     * @param Board $board
     * @return bool
     */
    public function makeFillTurn(Board $board)
    {
        if ($coords = $this->scanForGap($board, "horizontal")) {
            $board->setGrid($coords[0], $coords[1], $this->shape);
            return true;
        }

        if ($coords = $this->scanForGap($board, "vertical")) {
            $board->setGrid($coords[0], $coords[1], $this->shape);
            return true;
        }

        if ($coords = $this->scanForGap($board, "diagonal")) {
            $board->setGrid($coords[0], $coords[1], $this->shape);
            return true;
        }

        $coords = $this->getFreeRandomCoords($board);
        $board->setGrid($coords[0], $coords[1], $this->shape);
        return true;
    }
}
