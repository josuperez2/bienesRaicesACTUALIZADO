<?php 

require 'funciones.php'; 
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

$db = new mysqli('localhost', 'root', 'root', 'bienesraices_Crud', 3305);

if (!$db) {
    echo "Error al conectar con la base de datos";
    exit;
}


use Model\ActiveRecord;

ActiveRecord::setDB($db);

