<?php

namespace App;

class Vendedor extends ActiveRecord{

    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function sincronizar($args = []) {
    foreach ($args as $key => $value) {
        if (property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
        }
    }
}


    public function validar() {

    if (!$this->nombre) {
        self::$errores[] = "El nombre es obligatorio";
    }
    if (!$this->apellido) {
        self::$errores[] = "El apellido es obligatorio";
    }

    if (!$this->telefono) {
        self::$errores[] = "El teléfono es obligatorio";
    }

    if(!preg_match('/^[0-8]{8}$/', $this->telefono)){
        self::$errores[] = "Solo se admiten números de 8 dígitos";
    }

    return self::$errores;
}

}