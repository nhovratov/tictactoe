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
        if ($this->level === 1) {
            $this->makeRandomTurn($board);
        } elseif ($this->level === 2) {
            $this->botLvl2Turn($board);
        }
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

    /**
     * Looks for a free spot, if there are already 2 shapes in a line
     * @param $grid
     * @return array|bool
     */
    public function scanForGap($grid)
    {
        $rowCount = count($grid);
        for ($row = 0; $row < $rowCount; $row++) {

            if (!in_array($this->getShape(), $grid[$row])) {
                continue;
            }

            if (!in_array('', $grid[$row])) {
                continue;
            }

            $values = array_count_values($grid[$row]);
            $countBotShape = $values[$this->getShape()];

            //there must be enough shapes
            if ($countBotShape < TicTacToe::DIMENSION - 1) {
                continue;
            }

            $freeSpot = array_search('', $grid[$row]);

            return [$row, $freeSpot];
        }

        return false;
    }

    /**
     * Bot lvl 2 looks also for gaps else make random turn
     * @param Board $board
     * @return bool
     */
    public function botLvl2Turn(Board $board)
    {
        if ($coords = $this->scanForGap($board->getGrid())) {
            $board->setGrid($coords[0], $coords[1], $this->shape);
            return true;
        }

        if ($coords = $this->scanForGap($board->flipToRight())) {
            //flip the coordinates
            $board->setGrid($coords[1], $coords[0], $this->shape);
            return true;
        }

        if ($coords = $this->scanForGap($board->getDiagonals())) {
            $coords = $board->decodeDiagonalCoordinate($coords[0], $coords[1]);
            $board->setGrid($coords[0], $coords[1], $this->shape);
            return true;
        }

        $this->makeRandomTurn($board);
        return true;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        $this->level = (int) $level;
    }
}
