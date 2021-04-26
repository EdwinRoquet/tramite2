<?php
class Conexion{
    public function conectar(){

        // Producción
        // $this->user     = 'epsilonp_gerente';
        // $this->password = 'sOj!02UMY0m#';

        //  $ValUser = 'epsilonp_gerente';
        //  $ValPass = 'sOj!02UMY0m#';
         $ValUser = 'root';
         $ValPass = '';

        // $ValUser = 'root';
        // $ValPass = '';
         
        // dbname=epsilonp_BDEmpresa
        $link = new PDO("mysql:host=localhost;dbname=tramite",$ValUser,$ValPass,
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                              PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
                        );
        return $link;
    }
}
?>