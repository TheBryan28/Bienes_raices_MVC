<?php 

function conectarDB() : mysqli {
    //$db = new mysqli('localhost', 'root', 'root', 'bienes_raices');

    $db = new mysqli(
        $_ENV['DB_HOST'],
         $_ENV['DB_USER'], 
         $_ENV['DB_PASS'], 
         $_ENV['DB_BD']);
    $db->set_charset("utf8");//para no tener problemas con la ñ

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}