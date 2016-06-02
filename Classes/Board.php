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

    /**
     * TODO In das grid array einen bestimmten index füllen
     * @param string $x
     * @param string $y
     * @param string $shape
     */
    public function makeMove($x, $y, string $shape)
    {
        $this->grid[$x][$y] = $shape;
    }

    /**
     * Erstellt ein Mehrdimensionales Array mit leeren Strings für jeden Wert
     * 
     * @param $row
     * @param $cols
     * @return array
     */
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
     * TODO Das grid array um alle Einträge leeren
     */
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
    
    public function getGrid()
    {
        return $this->grid;
    }

}
