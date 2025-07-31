<?php



namespace Model;



class Propiedad extends ActiveRecord{

    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_Id'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_Id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date("Y-m-d");
        $this->vendedores_Id = $args['vendedores_Id'] ?? '';
    }

    public function validar(){

        if (!$this->titulo) {
        self::$errores[] = "debes añadir el titulo de la propiedad";
    }

    if (!$this->precio) {
        self::$errores[] = "debes añadir el precio de la propiedad";
    }

    if (strlen($this->descripcion) < 50) {
        self::$errores[] = "la descripción de la propiedad debe tener al menos 50 caracteres";
    }

    if (!$this->habitaciones) {
        self::$errores[] = "debes añadir el número de habitaciones de la propiedad";
    }

    if (!$this->wc) {
        self::$errores[] = "debes añadir el número de baños de la propiedad";
    }

    if (!$this->estacionamiento) {
        self::$errores[] = "debes añadir el número de estacionamientos de la propiedad";
    }

    if (!$this->vendedores_Id) {
        self::$errores[] = "debes añadir el vendedor de la propiedad";
    }

    if (!$this->imagen) {
        self::$errores[] = "La imagen de la propiedad es obligatoria";
    }

    return self::$errores;
    } 
    

}