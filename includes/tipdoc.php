<?php 

require_once "db.php";

class TipDoc {
    private $id;
    private $tipdoc;

/* ==========================================
   LISTAR TIPOS DE DOCUMENTOS
   ==========================================*/
   public function listarTipdoc(){
   	
   	$query = Conexion::conectar()->prepare("SELECT id,tipdoc FROM tra_tbtipdoc");
    
    $query->execute();

    return $query -> fetchAll();

	  $query->close();

   }
}
 ?>