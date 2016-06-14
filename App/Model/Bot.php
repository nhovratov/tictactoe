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
    /**
     * @param Board $board
     */
    public function makeRandomTurn(Board $board)
    {
        $generateRandomCoords = function () use ($board){
            $length = $board->getRows();
            $x = rand(0, $length);
            $y = rand(0, $length);
            return [$x, $y];
        };
        $coords = $generateRandomCoords();
        while (!empty($board->getGrid()[$coords[0]][$coords[1]]))
            $coords = $generateRandomCoords();

        $board->setGrid($coords[0], $coords[1], $this->shape);
    }

    /**
     * Checks if there is a gap which leads to a win when filled
     * @param Board $board
     * @return bool
     */
    public function makeFillTurn(Board $board)
    {
        $reverseGrid = function ($grid) {
            $count = count($grid);
            $newBoard = [];
            for ($i = 0; $i < $count; $i++) {
                $newBoard[$i] = array_column($grid, $i);
            }
            return $newBoard;
        };

        $getDiagonalGrid = function () use ($board) {
            $grid = $board->getGrid();
            $count = count($grid);
            $diagonalGrid = [];
            for ($i = 0, $j = $count-1; $i < $count; $i++, $j--) {
                $diagonalGrid[0][] = $grid[$i][$i];
                $diagonalGrid[1][] = $grid[$i][$j];
            }
            return $diagonalGrid;
        };

        $decodeDiagonalCoordinate = function ($row, $col) {
            $decodeTable = [
                [
                    0 => [0, 0],
                    1 => [1, 1],
                    2 => [2, 2]
                ],
                [
                    0 => [0, 2],
                    1 => [1, 1],
                    2 => [2, 0]
                ]
            ];

            return $decodeTable[$row][$col];
        };

        $scanBoard = function (Board $board, $orientation)
            use ($reverseGrid, $getDiagonalGrid, $decodeDiagonalCoordinate) {

            if ($orientation === "horizontal")
                $grid = $board->getGrid();
            elseif ($orientation === "vertical")
                $grid = $reverseGrid($board->getGrid());
            else
                $grid = $getDiagonalGrid($board->getGrid());

            $count = count($grid);
            for ($row = 0; $row < $count; $row++) {
                //the Bots shape is not in the array
                if (!in_array($this->getShape(), $grid[$row])) {
                    continue;
                }
                //there is no free empty space
                if (!in_array('', $grid[$row])) {
                    continue;
                }

                $values = array_count_values($grid[$row]);
                $countBotShape = $values[$this->getShape()];
                //there must be enough shapes
                if ($countBotShape < $count - 1) {
                    continue;
                }

                /*if there is only one empty space left and everything else is the Bots shape, gg!
                get the free spot */
                $freeSpot = array_search('', $grid[$row]);

                if ($orientation === "horizontal")
                    return [$row, $freeSpot];
                elseif ($orientation === "vertical")
                    return [$freeSpot, $row];
                else
                    return $decodeDiagonalCoordinate($row, $freeSpot);
            }

            return false;
        };


        if ($coords = $scanBoard($board, "horizontal")) {
            $board->setGrid($coords[0], $coords[1], $this->shape);
            return true;
        }

        if ($coords = $scanBoard($board, "vertical")) {
            $board->setGrid($coords[0], $coords[1], $this->shape);
            return true;
        }

        if ($coords = $scanBoard($board, "diagonal")) {
            $board->setGrid($coords[0], $coords[1], $this->shape);
            return true;
        };

        $generateRandomCoords = function () {
            $x = rand(0, 2);
            $y = rand(0, 2);
            return [$x, $y];
        };
        $coords = $generateRandomCoords();
        while (!empty($board->getGrid()[$coords[0]][$coords[1]]))
            $coords = $generateRandomCoords();

        $board->setGrid($coords[0], $coords[1], $this->shape);

        return true;
    }
}