<?php

namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }


    public function comprobarRuta()
    {
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

    //Muestra una vista
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;//asignar los datos
        }

        
        ob_start(); //almacenamiento en memoria durante un moomento

        include __DIR__ .  "/views/$view.php";

        $contenido = ob_get_clean(); //limpis el buffer

        include __DIR__ .  "/views/layout.php";
    }
}
