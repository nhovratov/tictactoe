<?php
spl_autoload_register(function ($class) {
    require_once __DIR__.DIRECTORY_SEPARATOR.'Model'.DIRECTORY_SEPARATOR. $class . '.php';
});
