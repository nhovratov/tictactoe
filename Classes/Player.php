<?php

class Player
{
    private $score = [];
    private $name = "";
    private $shape = "";
    
    public function __construct($name, $shape)
    {
        $this->name = $name;
        $this->shape = $shape;
    }

    public function getShape() 
    {
        return $this->shape;
    }
}