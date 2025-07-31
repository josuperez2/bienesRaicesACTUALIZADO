<?php

namespace Model;
class ActiveRecord{
    
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    //errores
    protected static $errores = [];
    
    
    public static function setDB($database){
        self::$db = $database;
    }

    

    public function guardar(){

     //sanitizar los datos
    $atributos = $this->sanitizarAtributos();

    //insertar en la base de datos
$query = "INSERT INTO " . static::$tabla  . "  (";
$query .= join(', ', array_keys($atributos));
$query .= ") VALUES ('";
$query .= join("','", array_values($atributos));
$query .= "')";
$resultado = self::$db->query($query);

if($resultado){
    header("Location: /admin?resultado=1");
    }
    }

    public function actualizar(){
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = $key . "='" . $value . "'";
        }

        $query = "UPDATE " . static::$tabla . " SET " . join(', ', $valores) . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $query .= join(', ', $valores);
        $query .= " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado){
            header("Location: /admin?resultado=2");
            }
    }
    //identificar y unir los atributos de la base de datos
    public function atributos(){
        //mapear los atributos de la clase a un arreglo
        $atributos = []; 
        foreach(static::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach( $atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    //validacion
    public static function getErrores(){  
        return static::$errores;
    }

    public function validar(){
    static::$errores =[];
    return static::$errores;
    }

    //lista todas las propiedades
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query); 

        return $resultado;
    }

    //obtiene determinado numero de registros
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query); 

        return $resultado;
    }

    public static function find($id) {
    $id = self::$db->escape_string($id);

    $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id} LIMIT 1";
    $resultado = self::consultarSQL($query);

    return array_shift($resultado); // Devuelve el primer resultado o null si no existe
}

public function eliminar() {
    // Si hay imagen, intenta eliminarla
    if (property_exists($this, 'imagen') && $this->imagen) {
        $imagenPath = '../imagenes/' . $this->imagen;
        if (file_exists($imagenPath)) {
            unlink($imagenPath); // Elimina la imagen del servidor
        }
    }

    // Eliminar de la base de datos
    $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
    $resultado = self::$db->query($query);

    return $resultado;
}


    public static function consultarSQL($query){
        //consultar la base de datos
        $resultado = self::$db->query($query);

        //iterar sobre los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }

        //liberar la cmemoria
        $resultado->free(); 
        //retornar el resultado

        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static();

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;

            }
        }
        return $objeto;
    }

}

