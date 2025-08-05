<?php


namespace Controllers;
use MVC\Router;

class propiedadController{
    public static function index(Router $router){
       
       $router->render('propiedades/admin', [
        
       ]);
        
    }

    public static function crear(){
        echo "Crear propiedad";
    }
    public static function actualizar(){
        echo "Actualizar propiedad";
    }
}