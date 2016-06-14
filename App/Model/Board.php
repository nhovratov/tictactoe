<?php

class Board
{
    protected $grid;
    protected $rows;
    protected $columns;
    
    public function __construct(int $rows, int $columns)
    {
        $this->rows = $rows;
        $this->columns = $columns;
        $this->grid = $this->createGrid($this->rows, $this->columns);
    }

    /**
     * Erstellt ein Mehrdimensionales Array mit leeren Strings für jeden Wert
     *
     * @param $rows
     * @param $cols
     * @param array $grid
     * @return array
     */
    public function createGrid($rows, $cols, $grid = []) {
        for ($i = 0; $i < $rows; $i++)
            $grid[$i] = array_fill(0, $cols, '');

        return $grid;
    }

    /**
     * fetches the chosen grid coordinates and return them as an array
     *
     * @param array $params
     * @return array
     */
    public function getParameters($params)
    {
        $params = explode("-", str_replace("cell-", "", key($params)));

        return array_map(function ($item) {
            return --$item;
        }, $params);
    }
    
    public function flipToRight()
    {
        $count = TicTacToe::DIMENSION;
        $flippedGrid = [];
        for ($i = 0; $i < $count; $i++) {
            $flippedGrid[$i] = array_column($this->grid, $i);
        }
        return $flippedGrid;
    }
    
    public function getDiagonals()
    {
        $count = TicTacToe::DIMENSION;
        $diagonals = [];
        for ($row = 0, $col = $count - 1; $row < $count; $row++, $col--) {
            $diagonals[0][] = $this->getGrid()[$row][$row];
            $diagonals[1][] = $this->getGrid()[$row][$col];
        }
        return $diagonals;
    }
    
    public function decodeDiagonalCoordinate($row, $col)
    {
        $decodeTable = [
            [[0, 0], [1, 1], [2, 2]],
            [[0, 2], [1, 1], [2, 0]]
        ];

        return $decodeTable[$row][$col];
    }

    /**
     * @param string $x
     * @param string $y
     * @param string $shape
     */
    public function setGrid($x, $y, string $shape)
    {
        $this->grid[$x][$y] = $shape;
    }

    /**
     * @return int
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @return int
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @return array
     */
    public function getGrid()
    {
        return $this->grid;
    }

}
