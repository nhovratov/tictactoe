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
        elseif
            ($this->level == 2)
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

        $scanBoardLinear = function (Board $board, $orientation) use ($reverseGrid, $getDiagonalGrid, $decodeDiagonalCoordinate) {
            if ($orientation === "horizontal")
                $grid = $board->getGrid();
            elseif ($orientation === "vertical")
                $grid = $reverseGrid($board->getGrid());
            else
                $grid = $getDiagonalGrid($board->getGrid());
            $count = count($grid);
            for ($i = 0; $i < $count; $i++) {
                if (in_array($this->getShape(), $grid[$i]) && in_array('', $grid[$i])) {
                    $values = array_count_values($grid[$i]);
                    $countBotShape = $values[$this->getShape()];
                    if ($countBotShape > 1) {
                        $freePosition = array_search('', $grid[$i]);

                        if ($orientation === "horizontal")
                            return [$i, $freePosition];
                        elseif ($orientation === "vertical")
                            return [$freePosition, $i];
                        else
                            return $decodeDiagonalCoordinate($i, $freePosition);
                    }
                }
            }
            return false;
        };


        if ($coords = $scanBoardLinear($board, "horizontal")) {
            $board->setGrid($coords[0], $coords[1], $this->shape);
            return true;
        }

        if ($coords = $scanBoardLinear($board, "vertical")) {
            $board->setGrid($coords[0], $coords[1], $this->shape);
            return true;
        }

        if ($coords = $scanBoardLinear($board, "diagonal")) {
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