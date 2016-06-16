<?php

class Renderer
{
    public static function partial($name, $data = [], $args = [])
    {
        include_once "../App/View/Partials/$name.inc.php";
    }
}
