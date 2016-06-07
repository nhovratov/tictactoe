<?php

class Bot extends Player
{
    /**
     * @param Board $board
     */
    public function makeAutoTurn(Board $board)
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
}