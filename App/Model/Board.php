<?php

class Board
{
    private $grid;
    protected $rows;
    private $columns;
    
    public function __construct(int $rows, int $columns)
    {
        $this->rows = $rows;
        $this->columns = $columns;
        $this->grid = $this->createGrid($this->rows, $this->columns);
    }

    /**
     * Erstellt ein Mehrdimensionales Array mit leeren Strings für jeden Wert
     * 
     * @param $row
     * @param $cols
     * @return array
     */
    protected function createGrid($row, $cols) {
        $grid = [];
        for ($i = 0; $i < $row; $i++) {
            $grid[] = [];
            for ($j = 0; $j < $cols; $j++) {
                array_push($grid[$i], "");
            }
        }
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
    
    /**
     * TODO Das grid array um alle Einträge leeren
     */
    public function resetGrid()
    {
        
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
