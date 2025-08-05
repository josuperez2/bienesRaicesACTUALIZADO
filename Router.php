<?php

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }


    public function comprobarRuta() {
    $urlActual = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $metodo = $_SERVER['REQUEST_METHOD'];

    if ($metodo === 'GET') {
        $fn = $this->rutasGET[$urlActual] ?? null;
    }

    if ($fn) {
        call_user_func($fn, $this);
    } else {
        echo "Página no encontrada";
    }
}

}