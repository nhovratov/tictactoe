<?php

class App
{
    protected $controller = 'TicTacToeController';

    protected $method = 'initiatePvCom';

    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (file_exists("../App/Controller/{$url['controller']}Controller.php")) {
            $this->controller = $url['controller'] . 'Controller';
            unset($url['controller']);
        }

        require_once "../App/Controller/$this->controller.php";
        $this->controller = new $this->controller;

        if (isset($url['action'])) {
            if (method_exists($this->controller, $url['action'])) {
                $this->method = $url['action'];
                unset($url['action']);
            }
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        return $_GET['tictactoe'] ?? $_GET['tictactoe'] ?? false;
    }
}
