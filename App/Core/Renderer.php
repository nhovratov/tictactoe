<?php

class Renderer
{
    public static function partial($name, $data = [], $args = [])
    {
        include "../App/View/Partials/$name.inc.php";
    }
    
    public static function layout($name, $data = [], $args = [])
    {
        include "../App/View/Layouts/$name.inc.php";
    }
}
