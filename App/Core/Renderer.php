<?php

class Renderer
{
    public static function partial($name, $data = [], $args = [])
    {
        include "../App/View/Partials/$name.inc.php";
    }
}
