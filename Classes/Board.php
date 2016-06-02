<?php

class Board
{
    private $grid;
    private $rows;
    private $columns;
    
    public function __construct(int $rows, int $columns)
    {
        $this->rows = $rows;
        $this->columns = $columns;
        $this->grid = $this->createGrid($this->rows, $this->columns);
    }
    
    public function makeMove()
    {
        
    }
    
    public function resetGrid()
    {
        
    }
    
    public function getRows()
    {
        return $this->rows;
    }


    public function getColumns()
    {
        return $this->columns;
    }

    public function createGrid($row, $cols) {
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
     * @return mixed
     */
    public function getGrid()
    {
        return $this->grid;
    }

}