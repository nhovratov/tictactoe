<?php

class Player
{
    protected $score = [];
    protected $name = "";
    protected $shape = "";
    
    public function __construct($name, $shape)
    {
        $this->name = $name;
        $this->shape = $shape;
    }

    public function getShape() 
    {
        return $this->shape;
    }
    
    public function makeTurn(Board $board, $coordinates)
    {
        if (!$board->setGrid($coordinates[0], $coordinates[1], $this->getShape())) {
            return false;
        };
        
        return true;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}