<?php

class Bot extends Player
{
    protected $level = 0;
    
    public function __construct($name, $shape, $level)
    {
        parent::__construct($name, $shape);
        $this->level = $level;
    }

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
        $generateRandomCoords = function () {
            $x = rand(0, 2);
            $y = rand(0, 2);
            return [$x, $y];
        };
        $coords = $generateRandomCoords();
        while (!empty($board->getGrid()[$coords[0]][$coords[1]]))
            $coords = $generateRandomCoords();

        $board->setGrid($coords[0], $coords[1], $this->shape);
    }

    /** TODO check diagonally
     * @param Board $board
     * @return bool
     */
    public function makeFillTurn(Board $board)
    {
        $reverseGrid = function ($grid) {
            $count = count($grid);
            $newBoard = [];
            for ($i = 0; $i < $count; $i++) {
                for ($j = 0; $j < $count; $j++) {
                    $newBoard[$j][] = $grid[$i][$j];
                }
            }
            return $newBoard;
        };
        $scanBoardLinear = function (Board $board, $orientation) use ($reverseGrid) {
            if ($orientation === "horizontal")
                $grid = $board->getGrid();
            else
                $grid = $reverseGrid($board->getGrid());

            $count = count($grid);
            for ($i = 0; $i < $count; $i++) {
                if (in_array($this->getShape(), $grid[$i]) && in_array('', $grid[$i])) {
                    $values = array_count_values($grid[$i]);
                    $countBotShape = $values[$this->getShape()];
                    if ($countBotShape > 1) {
                        $freePosition = array_search('', $grid[$i]);

                        if ($orientation === "horizontal")
                            return [$i, $freePosition];
                        else
                            return [$freePosition, $i];
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