<?php

class Controller
{
    public function model($model) {
        require_once "../App/Model/$model.php";
        return new $model;
    }

    public function view($view, $data = []) {
        require_once "../App/View/$view.php";
    }
}
