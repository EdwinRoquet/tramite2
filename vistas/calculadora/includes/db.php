<?php
class Conexion{
  static public function conectar(){

    
         $ValUser = 'root';
         $ValPass = '';  
         
        // dbname=tramite
        $link = new PDO("mysql:host=localhost;dbname=tramite",$ValUser,$ValPass,
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                              PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
                        );
        return $link;
    }
}