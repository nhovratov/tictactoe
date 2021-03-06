<?php

class Controller
{
    public function model($model, $param = null) {
        require_once "../App/Model/$model.php";
        if ($param)
            return new $model($param);
        else
            return new $model;
    }

    public function view($view, $data = []) {
        $render = new Renderer;
        require_once "../App/View/Templates/$view.php";
    }
}
